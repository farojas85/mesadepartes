<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\CargoTrait;

class CargoController extends Controller
{
    use CargoTrait;

    public function __construct()
    {
        $this->tituloVista = 'Cargos';
    }

    public function index(Request $request)
    {
        $cargos = $this->obtenerHabilitados($request);

        return view("configuracion.cargo.inicio",[
            'tituloVista'=> $this->tituloVista,
            'cargos' => $cargos
        ]);
    }

    public function habilitados(Request $request)
    {
        $cargos = $this->obtenerHabilitados($request);

        return view("configuracion.cargo.tabla",[
            'tituloVista'=> $this->tituloVista,
            'cargos' => $cargos
        ]);
    }

    public function eliminados(Request $request)
    {
        $cargos = $this->obtenerEliminados($request);

        return view("configuracion.cargo.tabla",[
            'tituloVista'=> $this->tituloVista,
            'cargos' => $cargos
        ]);
    }

    public function todos(Request $request)
    {
        $cargos = $this->obtenerTodos($request);

        return view("configuracion.cargo.tabla",[
            'tituloVista'=> $this->tituloVista,
            'cargos' => $cargos
        ]);
    }

    public function create()
    {
        $estadoCrud='nuevo';
        return view('configuracion.cargo.create',compact('estadoCrud'));
    }


    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required',
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $this->validate($request,$reglas,$mensaje);

        $cargo = Cargo::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cargo Registrado Satisfactoriamente'
        ], 200);
    }

    public function edit(Cargo $cargo)
    {
        $estadoCrud = 'editar';
        return view('configuracion.cargo.edit',compact('cargo','estadoCrud'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $reglas = [
            'nombre' => 'required',
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $cargo->nombre =  $request->nombre;
        $cargo->estado = ($request->estado) ? 1 : 0;
        $cargo->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cargo Modificado Satisfactoriamente'
        ], 200);
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->forceDelete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cargo eliminado permanentemente'
        ], 200);
    }

    public function destroyTemporal(Cargo $cargo)
    {
        $cargo->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cargo Enviado a Papelera Satisfactoriamente'
        ], 200);
    }

    public function restaurar(Request $request)
    {
        $cargo = Cargo::onlyTrashed()->where('id',$request->id);
        $cargo->restore();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cargo Restaurado Satisfactoriamente'
        ], 200);
    }
}
