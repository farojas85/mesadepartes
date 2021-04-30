<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Tramite extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id','anio','codigo_tramite','tipo_tramite_id','numero_folios',
        'asunto','estado_tramite_id'
    ];

    /**
     * Get the tipo_tramite that owns the Tramit
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_tramite(): BelongsTo
    {
        return $this->belongsTo(TipoTramite::class);
    }

    /**
     * Get the estado_tramite that owns the Tramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado_tramite(): BelongsTo
    {
        return $this->belongsTo(EstadoTramite::class);
    }

    /**
     * Get all of the archivos for the Tramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos(): HasMany
    {
        return $this->hasMany(Archivo::class);
    }
    /**
     * Get all of the movimientos for the Tramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }

    /**
     * Get the user that owns the Tramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function generarCodigo(int $anio) : string
    {
        //E2021-000000001
        $maxId = Tramite::select('codigo_tramite')
                    ->where('anio','=',$anio)->orderBy('codigo_tramite','desc')->first();

        if(!$maxId)
        {
            return 'E'.$anio.'-'.str_pad(1,9,"0",STR_PAD_LEFT);
        }
        $maximo =(int) substr($maxId->codigo_tramite,6);

        return 'E'.$anio.'-'.str_pad($maximo+1,9,"0",STR_PAD_LEFT);
    }
}
