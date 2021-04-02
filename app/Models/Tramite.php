<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Get all of the movimientos for the Tramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos(): HasMany
    {
        return $this->hasMany(Mivimiento::class);
    }
}