<?php
namespace App\Http\Traits;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Models\Tramite;
use App\Models\TipoTramite;
use App\Models\Archivo;
use App\Models\Persona;
use App\Models\Movimiento;
use App\Models\Area;
use App\Http\Traits\HelperTrait;


trait TramiteTrait
{
    public function obtenerMaxId()
    {
        return ( (Tramite::count('*') == null || Tramite::count('*')== '') ? 1 : Tramite::count('*')+1);
    }

    public function obtenerTipoTramitePorDocumentoTramite(Request $request)
    {
        return TipoTramite::select('id','nombre')
                ->where('documento_tramite_id',$request->documento_tramite_id)->get();
        //return view('tramite.partials.tipo-tramite-lista',compact('tipoTramites'));
    }

    public function guardarTramite(Request $request)
    {
        $regla = [
            'fecha_hora' => 'required',
            'documento_tramite_id' => 'required',
            'tipo_tramite_id' => 'required',
            'asunto' => 'required',
            'numero_folios' => 'required|numeric|not_in:0',
            'archivo' => 'required|mimes:pdf'
        ];

        $mensaje = [
            'required' => '* Dato Obligatorio',
            'file' => 'Seleccione un Archivo',
            'mimes' => 'Debe Agregar un Archivo  PDF',
            'not_in' => '* Ingrese valor mayor a 0',
            'numeric' => 'Ingreso Solo números'
        ];

        $this->validate($request,$regla,$mensaje);

        $tramite_count = Tramite::where('user_id',Auth::user()->id)
                    ->whereNotIn('estado_tramite_id',[5,7])
                    ->count('id');

        if($tramite_count == 0)
        {
            //Registramo el tramite
            $tramite = new Tramite();
            $tramite->anio = $request->anio;
            $tramite->codigo_tramite =  Tramite::generarCodigo($request->anio);
            $tramite->tipo_tramite_id = $request->tipo_tramite_id;
            $tramite->numero_folios = $request->numero_folios;
            $tramite->asunto = $request->asunto;
            $tramite->fecha_hora = $request->fecha_hora;
            $tramite->user_id = Auth::user()->id;
            $tramite->estado_tramite_id = 1;
            $tramite->save();

            //Guardamos el Archivo
            $documento = $request->file('archivo');

            $persona = Persona::findOrFail(Auth::user()->id);

            $ruta = $persona->numero_documento.'/archivos'.'/'.$tramite->codigo_tramite.'.'.$documento->getClientOriginalExtension();
            $nombre_archivo = $tramite->codigo_tramite.'.'.$documento->getClientOriginalExtension();
            Storage::disk('usuario')->put($ruta, File::get($documento));

            $archivo = new Archivo();
            $archivo->tramite_id = $tramite->id;
            $archivo->tipo_archivo_id= 1; //1 tipo tramite
            $archivo->archivo= $nombre_archivo;
            $archivo->save();

            //Registramos el Movimiento

            $area = Area::select('id')->where('siglas','like','OMP')->first();
            $movimiento = new Movimiento();
            $movimiento->tramite_id = $tramite->id;
            $movimiento->area_destino = $area->id;
            $movimiento->fecha = Carbon::now()->format('Y-m-d');
            $movimiento->hora = Carbon::now()->format('H:i:s');
            $movimiento->estado_tramite_id = 1;
            $movimiento->save();

            return response()->json([
                'ok' => 1,
                'mensaje' => 'Trámite Generado Satisfactoriamente'
            ], 200);

        }

        return response()->json([
            'ok' => 0,
            'mensaje' => 'Ya tienes un Trámite en proceso, espere a finalizarlo y vuelvar a Intentar!'
        ], 200);
    }
}
