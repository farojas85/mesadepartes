<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['id','nombre','directriz','estado'];

    public function menus() :BelongsToMany
    {
        return $this->belongsToMany(Menu::class)->withTimestamps();
    }

    /**
     * Get all of the comments for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function listarRoles()
    {
        return Role::select('id','nombre','directriz')->get();
    }

}
