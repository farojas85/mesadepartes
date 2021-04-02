<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoTramite;
use App\Models\DocumentoTramite;
use App\Http\Traits\TipoTramiteTrait;


class TipoTramiteController extends Controller
{
    use TipoTramiteTrait;

    public function __construct()
    {
        $this->tituloVista = 'Tipo Trámites';
    }


    public function index(Request $request)
    {
        $tipoTramites = $this->obtenerTodos($request);

        return view("configuracion.tipotramite.inicio",[
            'tituloVista' => $this->tituloVista,
            'tipoTramites' => $tipoTramites
        ]);

    }

    public function todos(Request $request)
    {
        $tipoTramites = $this->obtenerTodos($request);

        return view("configuracion.tipotramite.tabla",[
            'tituloVista' => $this->tituloVista,
            'tipoTramites' => $tipoTramites
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoCrud = 'nuevo';

        $documentoTramites = DocumentoTramite::select('id','nombre')->get();
        return view('configuracion.tipotramite.create', compact('estadoCrud','documentoTramites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->guardar($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoTramite  $tipoTramite
     * @return \Illuminate\Http\Response
     */
    public function show(TipoTramite $tipoTramite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoTramite  $tipoTramite
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoTramite $tipoTramite)
    {
        $estadoCrud = 'editar';
        $documentoTramites = DocumentoTramite::select('id','nombre')->get();

        //$tipoTramite->documento_tramite_id = $documentoTramites->nombre;
        return view('configuracion.tipotramite.edit',compact('tipoTramite','documentoTramites','estadoCrud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoTramite  $tipoTramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoTramite $tipoTramite)
    {
        $regla = [
            'documento_tramite_id' => 'required',
            'nombre' => 'required'
        ];

        $mensaje = [
            'required' => '* Campo Obligatorio'
        ];

        $tipoTramite->documento_tramite_id = $request->documento_tramite_id;
        $tipoTramite->nombre = $request->nombre;
        $tipoTramite->estado = ($request->estado) ? 1:0;
        $tipoTramite->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Trámite Modificado Satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoTramite  $tipoTramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoTramite $tipoTramite)
    {
        $tipoTramite->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Trámite eliminado Satisfactoriamente'
        ], 200);
    }

    public function listar(){
        return tipoTramite::select('id','nombre')->get();
    }
}
