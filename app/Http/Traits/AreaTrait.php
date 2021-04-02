<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Area;
use App\Http\Traits\HelperTrait;

trait AreaTrait
{
    use HelperTrait;

    public function obtenerHabilitados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);

        return Area::select('id','nombre','siglas','deleted_at',)
                ->where(function($query) use($buscar){
                    $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(siglas)'),'like','%'.$buscar.'%');
                })
                ->paginate($request->paginacion);
    }

    public function obtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);

        return Area::select('id','nombre','siglas','deleted_at',)
                ->where(function($query) use($buscar){
                    $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(siglas)'),'like','%'.$buscar.'%');
                })
                ->withTrashed()
                ->paginate($request->paginacion);
    }

    public function obtenerEliminados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);

        return Area::select('id','nombre','siglas','deleted_at',)
                ->where(function($query) use($buscar){
                    $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(siglas)'),'like','%'.$buscar.'%');
                })
                ->onlyTrashed()
                ->paginate($request->paginacion);
    }

    public function guardar(Request $request)
    {
        $regla = [
            'nombre' => 'required',
            'siglas' => 'required'
        ];

        $mensaje = [
            'required' => '* Dato Obligatorio'
        ];

        $this->validate($request,$regla,$mensaje);

        $area = new Area();
        $area->nombre = $request->nombre;
        $area->siglas = $request->siglas;
        $area->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario añadido Satisfactoriamente'
        ], 200);
    }
}
