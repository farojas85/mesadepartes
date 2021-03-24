<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentoTramite;

class DocumentoTramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Solicitud']);
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Carta']);
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Circular']);
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Sobre']);
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Constancia']);
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Copia de Documento']);
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Certificado']);
        $documento = DocumentoTramite::firstOrCreate(['nombre' =>'Memorandum']);
    }
}
