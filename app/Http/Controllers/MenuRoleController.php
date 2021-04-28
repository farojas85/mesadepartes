<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;

class MenuRoleController extends Controller
{
    public function index()
    {
        $roles = Role::select('id','nombre','directriz')->get();
        return view('sistema.menu-role.inicio',compact('roles'));
    }

    public function store(Request $request)
    {
        $role = Role::where('id',$request->menu_role_id)->first();

        $role->menus()->sync($request->get('menu_role'));

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Menús Asignados o Modificados para el Rol '.$role->nombre
        ], 200);
    }

    public function obtenerMenuRole(Request $request)
    {
        $menus = Menu::select('id','nombre','enlace')->where('estado',1)->get();

        $role = Role::with('menus')->where('id',$request->role)->first();

        return view('sistema.menu-role.menus',compact('menus','role'));
    }
}
