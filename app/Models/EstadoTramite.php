<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoTramite extends Model
{
    use HasFactory;

    protected $fillable = ['id','nombre','clase'];

    /**
     * Get all of the tramites for the EstadoTramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tramites(): HasMany
    {
        return $this->hasMany(Tramite::class);
    }

}
