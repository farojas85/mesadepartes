<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Cargo;
use App\Models\User;
use App\Models\Persona;
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

    public function show($id)
    {
        $estadoCrud = 'mostrar';

        $usuario = User::findOrFail($id);

        $persona = Persona::where('id',$usuario->persona_id)->first();
        $tipoDocumentos  = TipoDocumento::select('id','nombre')->get();
        $roles = Role::select('id','nombre','directriz')->get();
        $sexos = User::listarSexo();
        $cargos = Cargo::listarCargos();

        return view('sistema.usuario.show',compact('usuario','persona','tipoDocumentos','sexos','cargos','roles','estadoCrud'));
    }

    public function edit($id)
    {
        $estadoCrud= 'editar';

        $tipoDocumentos  = TipoDocumento::select('id','nombre')->get();
        $roles = Role::select('id','nombre','directriz')->get();
        $sexos = User::listarSexo();
        $cargos = Cargo::listarCargos();

        $usuario = User::findOrFail($id);
        $persona = Persona::findOrFail($usuario->persona_id);

        $usuario->tipo_documento_id = $persona->tipodocumento_id;
        $usuario->numero_documento = $persona->numero_documento;
        $usuario->nombres = $persona->nombres;
        $usuario->apellido_paterno = $persona->apellido_paterno;
        $usuario->apellido_materno = $persona->apellido_materno;
        $usuario->correo_personal = $persona->correo_personal;
        $usuario->telefono_celular = $persona->telefono_celular;
        $usuario->telefono_fijo = $persona->telefono_fijo;
        $usuario->sexo = $persona->sexo;

        return view('sistema.usuario.edit',compact('usuario','estadoCrud','tipoDocumentos','roles','sexos','cargos'));
    }

    public function update(Request $request)
    {
        return $this->actualizar($request);
    }

    public function destroy($id)
    {
        $usuario = User::withTrashed()->where('id',$id)->first();
        $usuario->forceDelete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario eliminado permanentemente'
        ], 200);
    }

    public function destroyTemporal($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario Enviado a Papelera Satisfactoriamente'
        ], 200);
    }

    public function restaurar(Request $request)
    {
        $usuario = User::onlyTrashed()->where('id',$request->id)->first();
        $usuario->restore();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Rol Restaurado Satisfactoriamente'
        ], 200);
    }

    public function mdlCambiarContrasena(Request $request)
    {
        $usuario = User::findOrFail($request->id);

        return view('sistema.usuario.mdlCambiarContrasena',compact('usuario'));
    }

    public function guardarContrasena(Request $request)
    {
        return $this->modificarContrasena($request);
    }

    public function perfilView()
    {
        $user = Auth::user();

        return view('sistema.usuario.perfil',compact('user'));
    }
}
