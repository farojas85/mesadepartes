<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoTramite extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'documento_tramite_id', 'nombre', 'estado'];

    /**
     * Get the documento_tramite that owns the TipoTramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function tramites(): HasMany
    {
        return $this->hasMany(Tramite::class);
    }

    public function documento_tramite(): BelongsTo
    {
        return $this->belongsTo(DocumentoTramite::class,);
    }
}
