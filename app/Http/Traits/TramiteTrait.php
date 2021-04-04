<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Tramite;
use App\Models\TipoTramite;
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
}
