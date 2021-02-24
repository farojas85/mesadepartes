<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipodocumento';

    protected $fillable = ['id','nombre'];

    public static function listado()
    {
        return TipoDocumento::select('id','nombre')->get();
    }
    /**
    * Get all of the comments for the TipoDocumento
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }
}
