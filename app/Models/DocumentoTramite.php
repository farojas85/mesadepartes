<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentoTramite extends Model
{
    use HasFactory;

    protected $fillable=['id','nombre'];

    /**
     * Get all of the tramites for the DocumentoTramite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tipo_tramites(): HasMany
    {
        return $this->hasMany(TipoTramite::class);
    }
}
