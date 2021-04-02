<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoArchivo;

class TipoArchivoSeeder extends Seeder
{
    public function run()
    {
        $tipo_archivo = TipoArchivo::firstOrCreate(['nombre'=>'Tramite']);
        $tipo_archivo = TipoArchivo::firstOrCreate(['nombre'=>'Respuesta']);
    }
}
