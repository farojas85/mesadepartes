<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

trait HelperTrait
{
    public function convertirMayuscula(Request $request) : string
    {
        $buscar='%';
        if($request->buscar)
        {
            $buscar = strtoupper($request->buscar);
        }
        return $buscar;
    }
}
