<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\TipoDocumentoTrait;

class TipoDocumentoController extends Controller
{
    use TipoDocumentoTrait;
    public function __construct()
    {
        $this->tituloVista = 'Tipodocumentos';
    }

    public function index(Request $request)
    {
        $tipodocumentos = $this->obtenerHabilitados($request);

        return view("configuracion.tipodocumento.inicio",[
            'tituloVista'=> $this->tituloVista,
            'tipodocumentos' => $tipodocumentos
        ]);
    }

    public function habilitados(Request $request)
    {
        $tipodocumentos = $this->obtenerHabilitados($request);

        return view("configuracion.tipodocumento.tabla",[
            'tituloVista'=> $this->tituloVista,
            'tipodocumentos' => $tipodocumentos
        ]);
    }

    public function eliminados(Request $request)
    {
        $tipodocumentos = $this->obtenerEliminados($request);

        return view("configuracion.tipodocumento.tabla",[
            'tituloVista'=> $this->tituloVista,
            'tipodocumentos' => $tipodocumentos
        ]);
    }

    public function todos(Request $request)
    {
        $tipodocumentos = $this->obtenerTodos($request);

        return view("configuracion.tipodocumento.tabla",[
            'tituloVista'=> $this->tituloVista,
            'tipodocumentos' => $tipodocumentos
        ]);
    }

    public function create()
    {
        $estadoCrud='nuevo';
        return view('configuracion.tipodocumento.create',compact('estadoCrud'));
    }


    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required',
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $this->validate($request,$reglas,$mensaje);

        $tipodocumento = TipoDocumento::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Documento Registrado Satisfactoriamente'
        ], 200);
    }


    public function edit(TipoDocumento $tipodocumento)
    {
        $estadoCrud = 'editar';
        return view('configuracion.tipodocumento.edit',compact('tipodocumento','estadoCrud'));
    }


    public function update(Request $request, TipoDocumento $tipodocumento)
    {
        $reglas = [
            'nombre' => 'required',
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $tipodocumento->nombre =  $request->nombre;
        $tipodocumento->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Documento Modificado Satisfactoriamente'
        ], 200);
    }

    public function destroy(TipoDocumento $tipodocumento)
    {
        $tipodocumento->forceDelete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Documento eliminado permanentemente'
        ], 200);
    }

    public function destroyTemporal(TipoDocumento $tipodocumento)
    {
        $tipodocumento->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Documento Enviado a Papelera Satisfactoriamente'
        ], 200);
    }


    public function restaurar(Request $request)
    {
        $tipodocumento = TipoDocumento::onlyTrashed()->where('id',$request->id);
        $tipodocumento->restore();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Documento Restaurado Satisfactoriamente'
        ], 200);
    }

    public function listado()
    {
        return TipoDocumento::select('id','nombre')->get();
    }
}
