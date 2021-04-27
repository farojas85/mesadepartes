<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Http\Traits\HelperTrait;

trait RoleTrait
{
    use HelperTrait;

    public function obtenerHabilitados(Request $request)
    {

        $buscar = $this->convertirMayuscula($request);

        return  Role::select(
                    'id','nombre','directriz',
                    DB::Raw("case
                                when estado = 1 then 'badge badge-success'
                                when estado = 0 then 'badge badge-secondary'
                            end as clase_estado
                    "),
                    DB::Raw("case
                                when estado = 1 then 'Activo'
                                when estado = 0 then 'Inactivo'
                            end as nombre_estado
                    "),'deleted_at'
                )->where( function($query) use($buscar){
                    $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(directriz)'),'like','%'.$buscar.'%');
                })->paginate($request->paginacion);

    }

    public function obtenerEliminados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);

        return  Role::select(
                    'id','nombre','directriz',
                    DB::Raw("case
                                when estado = 1 then 'badge badge-success'
                                when estado = 0 then 'badge badge-secondary'
                            end as clase_estado
                    "),
                    DB::Raw("case
                                when estado = 1 then 'Activo'
                                when estado = 0 then 'Inactivo'
                            end as nombre_estado
                    "),'deleted_at'
                )->where( function($query) use($buscar){
                    $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(directriz)'),'like','%'.$buscar.'%');
                })->onlyTrashed()->paginate($request->paginacion);

    }

    public function obtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);

        return  Role::select(
                    'id','nombre','directriz',
                    DB::Raw("case
                                when estado = 1 then 'badge badge-success'
                                when estado = 0 then 'badge badge-secondary'
                            end as clase_estado
                    "),
                    DB::Raw("case
                                when estado = 1 then 'Activo'
                                when estado = 0 then 'Inactivo'
                            end as nombre_estado
                    "),'deleted_at'
                )->where( function($query) use($buscar){
                    $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(directriz)'),'like','%'.$buscar.'%');
                })->withTrashed()->paginate($request->paginacion);

    }
}
