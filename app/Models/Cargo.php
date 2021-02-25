<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =['id','sede_id','area_id','subarea_id','nombre','estado'];

    public static function listarCargos()
    {
        return Cargo::select('id','nombre')->get();
    }
}
