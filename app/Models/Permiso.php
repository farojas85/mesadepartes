<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permiso extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id','nombre','directriz','descripcion'];

    /**
     * The roles that belong to the Permiso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public static function listarPermisos()
    {
        return Permiso::select('id','nombre','directriz','descripcion')->get();
    }

}
