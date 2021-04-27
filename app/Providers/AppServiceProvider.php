<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Menu;
use App\Models\Persona;
use App\Models\TipoDocumento;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Role;

use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        View()->composer("layouts.partials.sidebar", function($vista){
            $menus = Menu::getMenus(true);
            $vista->with('menus',$menus);
        });

        View()->composer('sistema.usuario.perfil',function($vista)
        {
            $usuario = Auth::user();
            $tipoDocumentos = TipoDocumento::select('id','nombre')->get();

            $sexos = User::listarSexo();

            $cargos = Cargo::select('id','nombre')->get();

            $roles = Role::select('id','nombre')->get();

            $vista->with('tipoDocumentos',$tipoDocumentos)->with('usuario',$usuario)
                    ->with('sexos',$sexos)->with('cargos',$cargos)->with('roles',$roles);
        });


    }
}
