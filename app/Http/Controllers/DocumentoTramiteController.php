<?php

namespace App\Http\Controllers;

use App\Models\DocumentoTramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\DocumentoTramiteTrait;

class DocumentoTramiteController extends Controller
{
    use DocumentoTramiteTrait;

    //public $tituloVista;
    //public $estadoCrud;

    public function __construct()
    {
        $this->tituloVista = 'Documento Trámites';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documento_tramites = $this->obtenerTodos($request);

        return view("configuracion.documento_tramite.inicio",[
            'tituloVista'=> $this->tituloVista,
            'documento_tramites' => $documento_tramites
        ]);
    }

    public function todos(Request $request)
    {
        $documento_tramites = $this->obtenerTodos($request);

        return view("configuracion.documento_tramite.tabla",[
            'tituloVista'=> $this->tituloVista,
            'documento_tramites' => $documento_tramites
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoCrud='nuevo';
        return view('configuracion.documento_tramite.create',compact('estadoCrud'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required',
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $this->validate($request,$reglas,$mensaje);

        $documento_tramite = DocumentoTramite::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Documento Trámite Registrado Satisfactoriamente'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentoTramite  $documentoTramite
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentoTramite $documentoTramite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentoTramite  $documentoTramite
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentoTramite $documentoTramite)
    {
        $estadoCrud = 'editar';
        return view('configuracion.documento_tramite.edit',compact('documentoTramite','estadoCrud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentoTramite  $documentoTramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentoTramite $documentoTramite)
    {
        $reglas = [
            'nombre' => 'required',
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $documentoTramite->nombre = $request->nombre;
        $documentoTramite->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Documento Trámite Modificado Satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentoTramite  $documentoTramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentoTramite $documentoTramite)
    {
        $documentoTramite->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Documento Trámite eliminado Satisfactoriamente'
        ], 200);
    }
}
