<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =['id','sede_id','area_id','subarea_id','nombre','estado'];

    /**
     * Get all of the comments for the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public static function listarCargos()
    {
        return Cargo::select('id','nombre')->get();
    }
}
