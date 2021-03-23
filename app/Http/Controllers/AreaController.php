<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\AreaTrait;

class AreaController extends Controller
{
    use AreaTrait;

    public $tituloVista;
    public $estadoCrud;

    public function __construct()
    {
        $this->tituloVista = 'Áreas';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $areas = $this->obtenerHabilitados($request);

         return view("configuracion.area.inicio",[
             'tituloVista'=> $this->tituloVista,
             'areas' => $areas
         ]);
     }

     public function habilitados(Request $request)
     {
         $areas = $this->obtenerHabilitados($request);

         return view("configuracion.area.tabla",[
             'tituloVista'=> $this->tituloVista,
             'areas' => $areas
         ]);
     }

     public function eliminados(Request $request)
     {
         $areas = $this->obtenerEliminados($request);

         return view("configuracion.area.tabla",[
             'tituloVista'=> $this->tituloVista,
             'areas' => $areas
         ]);
     }

     public function todos(Request $request)
     {
         $areas = $this->obtenerTodos($request);

         return view("configuracion.area.tabla",[
             'tituloVista'=> $this->tituloVista,
             'areas' => $areas
         ]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoCrud = 'nuevo';
        return view('configuracion.area.create',compact('estadoCrud'));
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
            'siglas' => 'required'
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $this->validate($request,$reglas,$mensaje);

        $area = Area::create([
            'nombre' => $request->nombre,
            'siglas' => $request->siglas,
        ]);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area Registrado Satisfactoriamente'
        ], 200);
    }

    public function edit(Area $area)
    {
        $estadoCrud = 'editar';
        return view('configuracion.area.edit',compact('area','estadoCrud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $reglas = [
            'nombre' => 'required',
            'siglas' => 'required'
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $area->nombre = $request->nombre;
        $area->siglas = $request->siglas;
        $area->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area Modificado Satisfactoriamente'
        ], 200);
    }

    public function destroy(Area $area)
    {
        $area->forceDelete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Área eliminado permanentemente'
        ], 200);
    }

    public function destroyTemporal(Area $area)
    {
        $area->delete();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Área Enviado A Papelera Satisfactoriamente'
        ], 200);
    }

    public function restaurar(Request $request)
    {
        $area = Area::onlyTrashed()->where('id',$request->id);
        $area->restore();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Área Restaurado Satisfactoriamente'
        ], 200);
    }
}
