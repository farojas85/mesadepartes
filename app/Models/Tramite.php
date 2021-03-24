<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tramite extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id','anio','codigo_tramite','documento_tramite_id',
        'sumilla','numero_folios','archivo','asunto','estado_tramite_id'
    ];

    /**
     * Get the documento_tramite that owns the Tramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documento_tramite(): BelongsTo
    {
        return $this->belongsTo(DocumentoTramite::Class);
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

}
