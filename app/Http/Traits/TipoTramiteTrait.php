<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\TipoTramite;
use App\Models\DocumentoTramite;
use App\Http\Traits\HelperTrait;

trait TipoTramiteTrait
{
    use HelperTrait;

    public function obtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
          return TipoTramite::with('documento_tramite:id,nombre')
                ->select(
                    'id','nombre','documento_tramite_id',
                    DB::Raw("case
                        when estado = 1 then 'badge badge-success'
                        when estado = 0 then 'badge badge-secondary'
                        end as estado_clase"),
                    DB::Raw("case
                        when estado = 1 then 'Activo'
                        when estado = 0 then 'Inactivo'
                        end as estado_nombre")
                )
                ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                //incluir de las tablas relacionadas -> buscar -> orWhereHas
                ->orWhereHas('documento_tramite', function($query) use($buscar){
                    $query->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%');
                })
                ->paginate($request->paginacion);
    }

    public function guardar(Request $request)
    {
        $regla = [
            'documento_tramite_id' => 'required',
            'nombre' => 'required',
        ];

        $mensaje = [
            'required' => '* Dato Obligatorio'
        ];

        $this->validate($request,$regla,$mensaje);

        $tipoTramite = new TipoTramite();
        $tipoTramite->documento_tramite_id = $request->documento_tramite_id;
        $tipoTramite->nombre = $request->nombre;
        $tipoTramite->estado = ($request->estado) ? 1 : 0;
        $tipoTramite->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Trámite añadido Satisfactoriamente'
        ], 200);

    }
}

