<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use App\Models\Role;
use App\Models\User;
use App\Http\Traits\TienePermisoTrait;
use App\Http\Traits\TieneRoleTrait;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('puede', function ($expression){
            $role = Role::where('id', Auth::user()->role_id)->first();
            return $role->tienePermisoDe($expression) ;
        });

    }
}
