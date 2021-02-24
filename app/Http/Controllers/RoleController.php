<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\RoleTrait;

class RoleController extends Controller
{
    use RoleTrait;

    public function __construct()
    {
        $this->tituloVista = 'Roles';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $this->obtenerHabilitados($request);

        return view("sistema.role.inicio",[
            'tituloVista'=> $this->tituloVista,
            'roles' => $roles
        ]);
    }

    public function habilitados(Request $request)
    {
        $roles = $this->obtenerHabilitados($request);

        return view("sistema.role.tabla",[
            'tituloVista'=> $this->tituloVista,
            'roles' => $roles
        ]);
    }
    public function eliminados(Request $request)
    {
        $roles = $this->obtenerEliminados($request);

        return view("sistema.role.tabla",[
                'tituloVista'=> $this->tituloVista,
                'roles' => $roles
        ]);
    }

    public function todos(Request $request)
    {
        $roles = $this->obtenerTodos($request);

        return view("sistema.role.tabla",[
                'tituloVista'=> $this->tituloVista,
                'roles' => $roles
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
        return view('sistema.role.create',compact('estadoCrud'));
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
            'directriz' => 'required'
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $this->validate($request,$reglas,$mensaje);

        $role = Role::create([
            'nombre' => $request->nombre,
            'directriz' => $request->directriz,
        ]);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Rol Registrado Satisfactoriamente'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $estadoCrud = 'editar';
        return view('sistema.role.edit',compact('role','estadoCrud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $reglas = [
            'nombre' => 'required',
            'directriz' => 'required'
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $role->nombre =  $request->nombre;
        $role->directriz = $request->directriz;
        $role->estado = ($request->estado) ? 1 : 0;
        $role->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Rol Modificado Satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->forceDelete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Rol eliminado permanentemente'
        ], 200);
    }

    public function destroyTemporal(Role $role)
    {
        $role->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Rol Enviado a Papelera Satisfactoriamente'
        ], 200);
    }

    public function restaurar(Request $request)
    {
        $role = Role::onlyTrashed()->where('id',$request->id);
        $role->restore();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Rol Restaurado Satisfactoriamente'
        ], 200);
    }
}
