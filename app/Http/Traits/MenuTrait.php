<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\Models\Menu;
use App\Http\Traits\HelperTrait;

trait MenuTrait
{
    use HelperTrait;

    public function obtenerHabilitados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
        //$paginacion = (!$request->paginacion) ? 5 : $request->paginacion;

        return Menu::select('id','nombre','enlace','imagen','orden','estado','deleted_at',
                DB::Raw("case
                            when estado = 1 then 'Activo'
                            when estado = 0 then 'Inactivo'
                        end as estado_nombre"),
                DB::Raw("case
                            when estado = 1 then 'badge badge-success'
                            when estado = 0 then 'badge badge-danger'
                        end as estado_clase")
            )
            ->where(function($query) use($buscar){
                $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(enlace)'),'like','%'.$buscar.'%');
            })->where('estado',1)->paginate($request->paginacion);
    }

    public function obtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
        //$paginacion = (!$request->paginacion) ? 5 : $request->paginacion;

        return Menu::select('id','nombre','enlace','imagen','orden','estado','deleted_at',
                DB::Raw("case
                            when estado = 1 then 'Activo'
                            when estado = 0 then 'Inactivo'
                        end as estado_nombre"),
                DB::Raw("case
                            when estado = 1 then 'badge badge-success'
                            when estado = 0 then 'badge badge-danger'
                        end as estado_clase")
            )
            ->where(function($query) use($buscar){
                $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(enlace)'),'like','%'.$buscar.'%');
            })->paginate($request->paginacion);
    }

    public function obtenerEliminados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
        //$paginacion = (!$request->paginacion) ? 5 : $request->paginacion;

        return Menu::select('id','nombre','enlace','imagen','orden','estado','deleted_at',
                DB::Raw("case
                            when estado = 1 then 'Activo'
                            when estado = 0 then 'Inactivo'
                        end as estado_nombre"),
                DB::Raw("case
                            when estado = 1 then 'badge badge-success'
                            when estado = 0 then 'badge badge-danger'
                        end as estado_clase")
            )
            ->where(function($query) use($buscar){
                $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(enlace)'),'like','%'.$buscar.'%');
            })->where('estado',0)->paginate($request->paginacion);
    }

    public function obtenerPermisos($roles)
    {
        return Menu::join('permiso_role as pr','permisos.id','=','pr.permiso_id')
                        ->select('permisos.id','permisos.nombre','permisos.directriz')
                        ->where('pr.role_id',$roles)->get();
    }

    public function guardar(Request $request)
    {
        $regla = [
            'nombre' => 'required'
        ];

        $mensaje = [
            'required' => '* Dato Obligatorio'
        ];

        $this->validate($request,$regla,$mensaje);

        $menu = new Menu();
        $menu->nombre = $request->nombre;
        $menu->enlace = $request->enlace;
        $menu->imagen = $request->imagen;
        $menu->nombre = $request->nombre;
        $menu->padre_id = $request->padre_id;
        $menu->orden = ($request->padre_id) ?  Menu::maximoHijoId($request->padre_id) : Menu::maximoPadreId();
        $menu->save();

        //$menu->estado = ($request->estado) ? 1 : 0;

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario añadido Satisfactoriamente'
        ], 200);

    }

    public function listarPadres()
    {
        return Menu::select('id','nombre')->whereNull('padre_id')->orderBy('orden','asc')->get();
    }

}
