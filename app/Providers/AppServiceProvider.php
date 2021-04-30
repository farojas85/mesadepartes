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
use App\Models\Tramite;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
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

        view()->composer('home', function($vista){
            $usuario = User::with(['role:id,nombre,directriz','cargo:id,nombre','area:id,nombre'])
                            ->where('id',Auth::user()->id)->first();

            $tramites_pendientes = 0;
            if($usuario->role->directriz == 'super-usuario' || $usuario->role->directriz == 'administrador'
                || $usuario->area->nombre == 'OFICINA MESA DE PARTES')
            {
                $tramites_pendientes = Tramite::whereHas('estado_tramite',function(Builder $query){
                                                $query->where('nombre','Generado');
                                            })->count();
            } else {
                $area_usuario = $usuario->area->nombre;
                $tramites_pendientes = Tramite::whereHas('estado_tramite',function(Builder $query){
                                            $query->where('nombre','Generado');
                                        })->whereHas('user.area',function(Builder $query) use($area_usuario){
                                            $query->where('nombre',$area_usuario);
                                        })->count();
            }

            $vista->with('tramites_pendientes',$tramites_pendientes);
        });

    }
}
