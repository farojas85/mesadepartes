<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimiento extends Model
{
    use HasFactory;

    /**
     * Get the tramite that owns the Movimiento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class);
    }
}
