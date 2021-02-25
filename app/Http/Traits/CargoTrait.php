<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Cargo;
use App\Http\Traits\HelperTrait;

trait CargoTrait
{
    use HelperTrait;

    public function obtenerHabilitados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
            return Cargo::select('id','nombre','deleted_at',
                    DB::Raw("case
                            when estado = 0 then 'Inactivo'
                            when estado = 1 then 'Activo'
                            end as nombre_estado"),
                    DB::Raw("case
                            when estado = 0 then 'badge badge-secondary'
                            when estado = 1 then 'badge badge-success'
                            end as clase_estado"))
                ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                ->paginate(5);
    }

    public function obtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
           return Cargo::select('id','nombre','deleted_at',
                    DB::Raw("case
                            when estado = 0 then 'Inactivo'
                            when estado = 1 then 'Activo'
                            end as nombre_estado"),
                    DB::Raw("case
                            when estado = 0 then 'badge badge-secondary'
                            when estado = 1 then 'badge badge-success'
                            end as clase_estado"))
                ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                ->withTrashed()->paginate(5);

    }

    public function obtenerEliminados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
             return Cargo::select('id','nombre','deleted_at',
             DB::Raw("case
                     when estado = 0 then 'Inactivo'
                     when estado = 1 then 'Activo'
                     end as nombre_estado"),
             DB::Raw("case
                     when estado = 0 then 'badge badge-secondary'
                     when estado = 1 then 'badge badge-success'
                     end as clase_estado"))
                ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                ->onlyTrashed()->paginate(5);

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

        $cargo = new Cargo();
        $cargo->nombre = $request->nombre;
        $cargo->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario añadido Satisfactoriamente'
        ], 200);

    }

}
