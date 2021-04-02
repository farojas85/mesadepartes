<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['id','nombre','siglas'];


    /**
     * Get all of the users for the Area
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public static function listarAreas()
    {
        return Area::select('id','nombre','siglas')->get();
    }
}

