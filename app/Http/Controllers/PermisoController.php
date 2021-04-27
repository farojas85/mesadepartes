<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Traits\PermisoTrait;

class PermisoController extends Controller
{
    use PermisoTrait;

    public function __construct()
    {
        $this->tituloVista = 'Permisos';
    }

    public function index(Request $request)
    {
        $permisos = $this->obtenerHabilitados($request);

        return view("sistema.permiso.inicio",[
            'tituloVista'=> $this->tituloVista,
            'permisos' => $permisos
        ]);
    }

    public function habilitados(Request $request)
    {
        $permisos = $this->obtenerHabilitados($request);

        return view("sistema.permiso.tabla",[
            'tituloVista'=> $this->tituloVista,
            'permisos' => $permisos
        ]);
    }

    public function eliminados(Request $request)
    {
        $permisos = $this->obtenerEliminados($request);

        return view("sistema.permiso.tabla",[
                'tituloVista'=> $this->tituloVista,
                'permisos' => $permisos
        ]);
    }

    public function todos(Request $request)
    {
        $permisos = $this->obtenerTodos($request);

        return view("sistema.permiso.tabla",[
                'tituloVista'=> $this->tituloVista,
                'permisos' => $permisos
        ]);
    }

    public function create()
    {
        $estadoCrud='nuevo';
        return view('sistema.permiso.create',compact('estadoCrud'));
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
            'directriz' => 'required',
            'descripcion' => 'required'
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $this->validate($request,$reglas,$mensaje);

        $permiso = Permiso::create([
            'nombre' => $request->nombre,
            'directriz' => $request->directriz,
            'descripcion' => $request->descripcion
        ]);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Permiso Registrado Satisfactoriamente'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit(Permiso $permiso)
    {
        $estadoCrud = 'editar';
        return view('sistema.permiso.edit',compact('permiso','estadoCrud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        $reglas = [
            'nombre' => 'required',
            'directriz' => 'required',
            'descripcion' => 'required'
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $permiso->nombre =  $request->nombre;
        $permiso->directriz = $request->directriz;
        $permiso->descripcion = $request->descripcion;
        $permiso->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Permiso Modificado Satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        $permiso->forceDelete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Permiso eliminado permanentemente'
        ], 200);
    }

    public function destroyTemporal(Permiso $permiso)
    {
        $permiso->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Permiso Enviado a Papelera Satisfactoriamente'
        ], 200);
    }

    public function restaurar(Request $request)
    {
        $permiso = Permiso::onlyTrashed()->where('id',$request->id);
        $permiso->restore();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Permiso Restaurado Satisfactoriamente'
        ], 200);
    }
}
