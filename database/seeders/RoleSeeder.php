<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrCreate(['nombre' => 'Super Usuario', 'directriz' => 'super-usuario','estado' => 1]);
        $role = Role::firstOrCreate(['nombre' => 'Administrador', 'directriz' => 'administrador','estado' => 1]);
        $role = Role::firstOrCreate(['nombre' => 'Administrativo', 'directriz' => 'administratico','estado' => 1]);
        $role = Role::firstOrCreate(['nombre' => 'Docente', 'directriz' => 'docente','estado' => 1]);
    }
}
