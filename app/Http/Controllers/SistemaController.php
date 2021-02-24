<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
class SistemaController extends Controller
{
    public function __construct()
    {
        $this->tituloVista = 'Roles';
    }

    public function index()
    {
        $tituloVista = 'Roles';

        return view('sistema.inicio',['tituloVista' => $tituloVista]);
    }
}
