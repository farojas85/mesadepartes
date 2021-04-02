<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
