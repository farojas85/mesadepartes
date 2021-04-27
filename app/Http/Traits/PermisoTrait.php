<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\Models\Permiso;
use App\Http\Traits\HelperTrait;

trait PermisoTrait
{
    use HelperTrait;

    public function obtenerHabilitados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
        //$paginacion = (!$request->paginacion) ? 5 : $request->paginacion;

        return Permiso::select('id','nombre','directriz','descripcion','deleted_at')
            ->where(function($query) use($buscar){
                $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(directriz)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(descripcion)'),'like','%'.$buscar.'%');
            })->paginate($request->paginacion);
    }

    public function obtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
        //$paginacion = (!$request->paginacion) ? 5 : $request->paginacion;

        return Permiso::select('id','nombre','directriz','descripcion','deleted_at')
            ->where(function($query) use($buscar){
                $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(directriz)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(descripcion)'),'like','%'.$buscar.'%');
            })->withTrashed()->paginate($request->paginacion);
    }

    public function obtenerEliminados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
        //$paginacion = (!$request->paginacion) ? 5 : $request->paginacion;

        return Permiso::select('id','nombre','directriz','descripcion','deleted_at')
            ->where(function($query) use($buscar){
                $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(directriz)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw('upper(descripcion)'),'like','%'.$buscar.'%');
            })->onlyTrashed()->paginate($request->paginacion);
    }

    public function obtenerPermisos($roles)
    {
        return Permiso::join('permiso_role as pr','permisos.id','=','pr.permiso_id')
                        ->select('permisos.id','permisos.nombre','permisos.directriz')
                        ->where('pr.role_id',$roles)->get();
    }

}
