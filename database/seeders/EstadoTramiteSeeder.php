<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoTramite;
class EstadoTramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Pendiente', 'clase' =>'badge badge-danger']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Derivado', 'clase' =>'badge badge-orange']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Proceso', 'clase' =>'badge badge-primary']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Aceptado', 'clase' =>'badge bg-lime']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Terminado', 'clase' =>'badge badge-success']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Observado', 'clase' =>'badge bg-warning']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Archivado', 'clase' =>'badge bg-navy']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Anulado', 'clase' =>'badge badge-secondary']);
        $estado = EstadoTramite::firstOrCreate(['nombre'=>'Duplicado', 'clase' =>'badge bg-indigo']);
    }
}
