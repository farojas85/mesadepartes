<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Permiso;
use App\Models\Role;

class PermisoRoleController extends Controller
{
    public function index()
    {
        $roles = Role::select('id','nombre','directriz')->get();
        $modelos = $this->mostrarModelos();

        return view('sistema.permiso-role.inicio',compact('roles','modelos'));
    }

    public function store(Request $request)
    {
        $role = Role::where('id',$request->permiso_role_id)->first();

        $role->permisos()->sync($request->get('permiso_role'));

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Permisos Asignados o Modificados para el Rol '.$role->nombre
        ], 200);
    }


    public function mostrarModelos()
    {
        return  Permiso::select(DB::Raw("DISTINCT( SUBSTRING_INDEX(SUBSTRING_INDEX(directriz, '.', 1), '.', -1)) as nombre"))
                            ->orderBy('nombre')->get();
    }

    public function obtenerPermisoRole(Request $request)
    {
        $permisos = Permiso::select('id','nombre','directriz','descripcion')
                        ->where('directriz','like',$request->modelo.'%')->whereNull('deleted_at')->get();

        $role = Role::with('permisos')->where('id',$request->role)->first();

        return view('sistema.permiso-role.permisos',compact('permisos','role'));
    }
}
