<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\DocumentoTramite;
use App\Http\Traits\HelperTrait;

trait DocumentoTramiteTrait
{
    use HelperTrait;

    public function obtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);

           return DocumentoTramite::select('id','nombre')
                    ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                    ->paginate($request->paginacion);
    }

    public function guardar(Request $request)
    {
        $regla = [
            'nombre' => 'required',
        ];

        $mensaje = [
            'required' => '* Dato Obligatorio'
        ];

        $this->validate($request,$regla,$mensaje);

        $documento_tramite = new DocumentoTramite();
        $documento_tramite->nombre = $request->nombre;
        $documento_tramite->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Documento de Trámite añadido Satisfactoriamente'
        ], 200);
    }
}
