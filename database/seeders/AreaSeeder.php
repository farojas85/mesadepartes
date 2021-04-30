<?php

namespace Database\Seeders;
use App\Models\Area;

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = Area::firstOrCreate(['nombre' => 'ÁREA DE GESTIÓN PEDAGÓGICA DOCENTES', 'siglas' => 'AGPD']);
    }
}
