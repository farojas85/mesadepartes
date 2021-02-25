<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use Peru\Sunat\{HtmlParser, Ruc, RucParser};

use Storage;
use File;
use App\Models\Role;
use App\Models\TipoDocumento;
use App\Models\Persona;
use App\Models\User;
use App\Http\Traits\HelperTrait;

trait UserTrait
{
    use HelperTrait;
    public function obtenerHabilitados(Request $request)
    {

        $buscar = $this->convertirMayuscula($request);

        return User::join('personas as pe','users.persona_id','=','pe.id')
                ->join('tipodocumento as tp','pe.tipodocumento_id','=','tp.id')
                ->join('cargos as ca','users.cargo_id','=','ca.id')
                ->join('roles as ro','users.role_id','=','ro.id')
                ->select('users.id','users.usuario_codigo','pe.numero_documento',
                    DB::Raw("concat(pe.nombres,' ',pe.apellidO_paterno,' ',pe.apellido_materno) as nombre_usuario"),
                    'ca.nombre as cargo','ro.nombre as rol','users.deleted_at',
                    DB::Raw("case
                        when users.estado = 1 then 'badge badge-success'
                        when users.estado = 0 then 'badge badge-secondary'
                        end as estado_clase"),
                    DB::Raw("case
                        when users.estado = 1 then 'Activo'
                        when users.estado = 0 then 'Inactivo'
                        end as estado_nombre"))
                ->where(function($query) use($buscar){
                    $query->where(DB::Raw('upper(pe.numero_documento)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(pe.nombres)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw("concat(upper(pe.apellido_paterno),' ',upper(pe.apellido_materno))"),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(ca.nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw("upper(ro.nombre)"),'like','%'.$buscar.'%');
                })->paginate(5);

                // $buscar = $this->convertirMayuscula($request);
                // return Cargo::select('id','nombre')
                //->where(DB::Raw('upper(nombre)'),'like','%'.$buscar.'%')
                // ->paginate(5);
    }

    public function obtenerTodos(Request $request)
    {

        $buscar = $this->convertirMayuscula($request);

        return User::join('personas as pe','users.persona_id','=','pe.id')
                ->join('tipodocumento as tp','pe.tipodocumento_id','=','tp.id')
                ->join('cargos as ca','users.cargo_id','=','ca.id')
                ->join('roles as ro','users.role_id','=','ro.id')
                ->select('users.id','users.usuario_codigo','pe.numero_documento',
                    DB::Raw("concat(pe.nombres,' ',pe.apellidO_paterno,' ',pe.apellido_materno) as nombre_usuario"),
                    'ca.nombre as cargo','ro.nombre as rol','users.deleted_at',
                    DB::Raw("case
                        when users.estado = 1 then 'badge badge-success'
                        when users.estado = 0 then 'badge badge-secondary'
                        end as estado_clase"),
                    DB::Raw("case
                        when users.estado = 1 then 'Activo'
                        when users.estado = 0 then 'Inactivo'
                        end as estado_nombre"))
                ->where(function($query) use($buscar){
                    $query->where(DB::Raw('upper(pe.numero_documento)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(pe.nombres)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw("concat(upper(pe.apellido_paterno),' ',upper(pe.apellido_materno))"),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(ca.nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw("upper(ro.nombre)"),'like','%'.$buscar.'%');
                })->withTrashed()->paginate(5);

    }

    public function obtenerEliminados(Request $request)
    {

        $buscar = $this->convertirMayuscula($request);

        return User::join('personas as pe','users.persona_id','=','pe.id')
                ->join('tipodocumento as tp','pe.tipodocumento_id','=','tp.id')
                ->join('cargos as ca','users.cargo_id','=','ca.id')
                ->join('roles as ro','users.role_id','=','ro.id')
                ->select('users.id','users.usuario_codigo','pe.numero_documento',
                    DB::Raw("concat(pe.nombres,' ',pe.apellidO_paterno,' ',pe.apellido_materno) as nombre_usuario"),
                    'ca.nombre as cargo','ro.nombre as rol','users.deleted_at',
                    DB::Raw("case
                        when users.estado = 1 then 'badge badge-success'
                        when users.estado = 0 then 'badge badge-secondary'
                        end as estado_clase"),
                    DB::Raw("case
                        when users.estado = 1 then 'Activo'
                        when users.estado = 0 then 'Inactivo'
                        end as estado_nombre"))
                ->where(function($query) use($buscar){
                    $query->where(DB::Raw('upper(pe.numero_documento)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(pe.nombres)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw("concat(upper(pe.apellido_paterno),' ',upper(pe.apellido_materno))"),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw('upper(ca.nombre)'),'like','%'.$buscar.'%')
                        ->orWhere(DB::Raw("upper(ro.nombre)"),'like','%'.$buscar.'%');
                })->onlyTrashed()->paginate(5);

    }

    public function verificarNumeroDocumento(Request $request)
    {
        //VALIDAMOS EL TIPO DE DOCUMENTO
        $regla = [ 'tipo_documento_id' => 'required'];
        $mensaje = [ 'required' => '* Dato Obligatorio'];
        $this->validate($request,$regla,$mensaje);

        //VALIDAMOS EL NUMERO DE DOCUMENTO POR LONGITUD
        $tipoDocumento = TipoDocumento::select('nombre')
                                    ->where('id',$request->tipo_documento_id)->first();
        $digitos =($tipoDocumento->nombre == 'DNI/LE' ) ? 8 : 15;

        $regla = [
            'tipo_documento_id' => 'required',
            'numero_documento' => 'digits:'.$digitos
        ];
        $mensaje = [ 'required' => '* Dato Obligatorio',
                    'digits' => 'Ingrese '.$digitos.' dígitos'];

        $this->validate($request,$regla,$mensaje);

        $persona = null;
        if($digitos == 8)
        {
            $cs = new Dni(new ContextClient(), new DniParser());

            $persona = $cs->get($request->numero_documento);
            if (!$persona) {
                return null;
            }
        }
        return response()->json(['persona' => $persona], 200);
    }

    public function guardar(Request $request)
    {
        $regla = [
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required',
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'sexo' => 'required',
            'usuario_codigo' => 'required',
            'password' => 'required',
            'cargo_id' => 'required',
            'role_id' => 'required'
        ];

        $mensaje = [
            'required' => '* Dato Obligator'
        ];

        $this->validate($request,$regla,$mensaje);

        $persona = new Persona();
        $persona->tipodocumento_id = $request->tipo_documento_id;
        $persona->numero_documento = $request->numero_documento;
        $persona->nombres = $request->nombres;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->correo_personal = $request->correo_personal;
        $persona->telefono_celular = $request->telefono_celular;
        $persona->telefono_fijo = $request->telefono_fijo;
        $persona->sexo = $request->sexo;
        $persona->save();

        $usuario = new User();
        $usuario->persona_id = $persona->id;
        $usuario->usuario_codigo = $request->numero_documento;
        $usuario->usuario_email = $request->usuario_email;
        $usuario->password =Hash::make($request->password);
        $usuario->numero_celular = $request->numero_celular;
        $usuario->numero_anexo = $request->numero_anexo;
        $usuario->cargo_id = $request->cargo_id;
        $usuario->role_id = $request->role_id;
        $usuario->foto = ($request->sexo=='F') ? 'user_mujer.png' : 'user_varon.png';

        $usuario->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario añadido Satisfactoriamente'
        ], 200);

    }

    public function actualizar(Request $request)
    {
        $regla = [
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required',
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'sexo' => 'required',
            'usuario_codigo' => 'required',
            'cargo_id' => 'required',
            'role_id' => 'required'
        ];

        $mensaje = [
            'required' => '* Dato Obligator'
        ];

        $this->validate($request,$regla,$mensaje);

        $usuario = User::findOrfail($request->id);

        $persona = Persona::findOrFail($usuario->persona_id);

        $persona->tipodocumento_id = $request->tipo_documento_id;
        $persona->numero_documento = $request->numero_documento;
        $persona->nombres = $request->nombres;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->correo_personal = $request->correo_personal;
        $persona->telefono_celular = $request->telefono_celular;
        $persona->telefono_fijo = $request->telefono_fijo;
        $persona->sexo = $request->sexo;
        $persona->save();

        $usuario->usuario_codigo = $request->usuario_codigo;
        $usuario->usuario_email = $request->usuario_email;
        $usuario->numero_celular = $request->numero_celular;
        $usuario->numero_anexo = $request->numero_anexo;
        $usuario->cargo_id = $request->cargo_id;
        $usuario->role_id = $request->role_id;
        $usuario->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario añadido Satisfactoriamente'
        ], 200);
    }

}
