<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Cargo;
use App\Models\User;
use App\Models\TipoDocumento;
use App\Http\Traits\UserTrait;

class UserController extends Controller
{
    use UserTrait;

    public function __construct()
    {
        $this->tituloVista = 'Usuarios';
    }


    public function index(Request $request)
    {
        $usuarios = $this->obtenerHabilitados($request);

        return view("sistema.usuario.inicio",[
            'tituloVista'=> $this->tituloVista,
            'usuarios' => $usuarios
        ]);
    }


    public function habilitados(Request $request)
    {
        $usuarios = $this->obtenerHabilitados($request);

        return view("sistema.usuario.tabla",[
            'tituloVista'=> $this->tituloVista,
            'usuarios' => $usuarios
        ]);
    }
    public function eliminados(Request $request)
    {
        $usuarios = $this->obtenerEliminados($request);

        return view("sistema.usuario.tabla",[
                'tituloVista'=> $this->tituloVista,
                'usuarios' => $usuarios
        ]);
    }

    public function todos(Request $request)
    {
        $usuarios = $this->obtenerTodos($request);

        return view("sistema.usuario.tabla",[
                'tituloVista'=> $this->tituloVista,
                'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        $estadoCrud='nuevo';
        $tipoDocumentos = TipoDocumento::listado();
        $sexos = User::listarSexo();
        $roles = Role::listarRoles();
        $cargos = Cargo::listarCargos();

        return view('sistema.usuario.create',compact('estadoCrud','tipoDocumentos','sexos','roles','cargos'));
    }

    public function verificarDocumento(Request $request)
    {
        return $this->verificarNumeroDocumento($request);
    }

    public function store(Request $request)
    {
        return $this->guardar($request);
    }
}
