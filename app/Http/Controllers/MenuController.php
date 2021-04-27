<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Traits\MenuTrait;

class MenuController extends Controller
{
    use MenuTrait;
    public function __construct()
    {
        $this->tituloVista = 'Menús';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = $this->obtenerHabilitados($request);

        return view('sistema.menu.inicio',[
            'tituloVista'=> $this->tituloVista,
            'menus' => $menus
        ]);
    }

    public function habilitados(Request $request)
    {
        $menus = $this->obtenerHabilitados($request);

        return view("sistema.menu.tabla",[
            'tituloVista'=> $this->tituloVista,
            'menus' => $menus
        ]);
    }

    public function eliminados(Request $request)
    {
        $menus = $this->obtenerEliminados($request);

        return view("sistema.menu.tabla",[
                'tituloVista'=> $this->tituloVista,
                'menus' => $menus
        ]);
    }

    public function todos(Request $request)
    {
        $menus = $this->obtenerTodos($request);

        return view("sistema.menu.tabla",[
                'tituloVista'=> $this->tituloVista,
                'menus' => $menus
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoCrud="nuevo";

        $padres = $this->listarPadres();
        return view('sistema.menu.create',compact('estadoCrud','padres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->guardar($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $padres = $this->listarPadres();
        $estadoCrud = 'editar';
        return view('sistema.menu.edit',compact('menu','estadoCrud','padres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $reglas = [
            'nombre' => 'required',
        ];

        $mensaje = ['required' => '* Campo Obligatorio'];

        $menu->nombre =  $request->nombre;
        $menu->enlace = $request->enlace;
        $menu->estado = ($request->estado) ? 1 : 0;
        $menu->padre_id = $request->padre_id;
        $menu->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Menú Modificado Satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->estado = 0;
        $menu->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Menú Inhabilitado Satisfactoriamente'
        ], 200);
    }

    public function restaurar(Request $request)
    {
        $menu = Menu::findOrFail($request->id);
        $menu->estado = 1;
        $menu->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Menú habilitado Satisfactoriamente'
        ], 200);
    }
}
