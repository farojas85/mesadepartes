<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadotramite;
class EstadoTramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Pendiente', 'clase' =>'badge badge-danger']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Derivado', 'clase' =>'badge badge-orange']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Proceso', 'clase' =>'badge badge-primary']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Aceptado', 'clase' =>'badge bg-lime']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Terminado', 'clase' =>'badge badge-success']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Observado', 'clase' =>'badge bg-warning']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Archivado', 'clase' =>'badge bg-navy']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Anulado', 'clase' =>'badge badge-secondary']);
        $estado = Estadotramite::firstOrCreate(['nombre'=>'Duplicado', 'clase' =>'badge bg-indigo']);
    }
}
