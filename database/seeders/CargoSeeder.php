<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;
class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargo = Cargo::firstOrCreate(['nombre' => 'DIRECTOR DE SISTEMA ADMINISTRATIVO']);

    }
}
