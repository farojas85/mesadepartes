<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\TipoDocumento;
use App\Http\Traits\HelperTrait;

trait TipoDocumentotrait
{
    use HelperTrait;

    public function obtenerHabilitados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
           return TipoDocumento::select('id','nombre','deleted_at')
                ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                ->paginate(5);

    }

    public function obtenerEliminados(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
        return  TipoDocumento::select( 'id','nombre','deleted_at')
                ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                ->onlyTrashed()->paginate(5);

    }

    public function ObtenerTodos(Request $request)
    {
        $buscar = $this->convertirMayuscula($request);
           return TipoDocumento::select('id','nombre','deleted_at')
                ->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                ->withTrashed()->paginate(5);

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

        $tipodocumento = new TipoDocumento();
        $tipodocumento->nombre = $request->nombre;
        $tipodocumento->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Documento añadido Satisfactoriamente'
        ], 200);

    }
}
