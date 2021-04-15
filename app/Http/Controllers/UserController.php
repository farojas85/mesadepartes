<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\Area;
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
        $areas = Area::listarAreas();

        return view('sistema.usuario.create',compact('estadoCrud','tipoDocumentos','sexos','roles','areas','cargos'));
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
        $areas = Area::listarAreas();
        $cargos = Cargo::listarCargos();

        return view('sistema.usuario.show',compact('usuario','persona','tipoDocumentos','sexos','areas','cargos','roles','estadoCrud'));
    }

    public function edit($id)
    {
        $estadoCrud= 'editar';

        $tipoDocumentos  = TipoDocumento::select('id','nombre')->get();
        $roles = Role::select('id','nombre','directriz')->get();
        $sexos = User::listarSexo();
        $areas = Area::listarAreas();
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

        return view('sistema.usuario.edit',compact('usuario','estadoCrud','tipoDocumentos','roles','sexos','areas','cargos'));
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
        return view('sistema.usuario.perfil');
    }

    public function mdlSubirFoto(Request $request)
    {
        $usuario = User::findOrFail($request->id);

        return view('sistema.usuario.mdlSubirFoto',compact('usuario'));
    }

    public function guardarFoto(Request $request)
    {
        $regla = [
            'foto' => 'required|file',
        ];
        $mensaje= [
            'required' => '* Campo Obligatorio'];

        $this->validate($request,$regla,$mensaje);

        if($archivo = $request->file('foto'))
        {

            if(mb_strtoupper($archivo->getClientOriginalExtension()) != 'JPG' &&
                mb_strtoupper($archivo->getClientOriginalExtension()) != 'PNG' &&
                mb_strtoupper($archivo->getClientOriginalExtension()) != 'JPEG')
            {
                $error = [
                    'errors' => [
                        'foto' => [
                            'El archivo debe tener la extención (.jpg, .png, .jpeg)'
                        ]
                    ]
                ];

                return response()->json($error, 422);
            }

            $persona = Persona::findOrFail(Auth::user()->id);

            $nombre = $persona->numero_documento.'/'.$persona->numero_documento.'.'.$archivo->getClientOriginalExtension();

            Storage::disk('usuario')->put($nombre, File::get($archivo));

            $user = User::where('id',Auth::user()->id)->first();
            // //$persona = Persona::where('dni',$user->persona_dni)->first();


            $user->foto = $persona->numero_documento.'.'.$archivo->getClientOriginalExtension();
            $user->save();

            return response()->json([
                'ok' => 1,
                'mensaje' => 'Foto de Usuario Modificado Satisfactoriamente'
            ], 200);

        } else {

            $validator = Validator::make($request->all(), [
                'foto' => 'required|file',
            ]);
        }
    }

    public function mdlMostrarDatoPersonal()
    {
        $usuario = Auth::user();

        return view('sistema.usuario.mostrarDatoPersona',compact('usuario'));
    }

    public function mdlEditarDatoPersonal()
    {
        $usuario = Auth::user();

        return view('sistema.usuario.editarDatoPersonal',compact('usuario'));
    }

    public function mdlMostrarDatoUsuario()
    {
        $usuario = Auth::user();

        return view('sistema.usuario.mostrarDatoUsuario',compact('usuario'));
    }

    public function mdlEditarDatoUsuario()
    {
        $usuario = Auth::user();

        return view('sistema.usuario.editarDatoUsuario',compact('usuario'));
    }

    public function actualizarDatoPersonal(Request $request)
    {
        return $this->modificarDatoPersonal($request);
    }

    public function actualizarDatoUsuario(Request $request)
    {
        return $this->modificarDatoUsuario($request);
    }
}
