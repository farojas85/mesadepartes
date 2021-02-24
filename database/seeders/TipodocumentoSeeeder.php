<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipodocumentoSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipodocumento = TipoDocumento::firstOrCreate(['nombre' => 'DNI/LE']);
        $tipodocumento = TipoDocumento::firstOrCreate(['nombre' => 'Carnet Ext.']);
    }
}
