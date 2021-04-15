<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archivo extends Model
{
    use HasFactory;

    /**
     * Get the tipo_archivo that owns the Archivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_archivo(): BelongsTo
    {
        return $this->belongsTo(TipoArchivo::class, );
    }

    /**
     * Get the tramite that owns the Archivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class);
    }
}
