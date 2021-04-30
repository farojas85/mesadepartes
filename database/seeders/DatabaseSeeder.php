<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            TipodocumentoSeeder::class,
            UsuarioMasterSeeder::class,
            MenuSeeder::class,
            AreaSeeder::class,
            CargoSeeder::class,
            DocumentoTramiteSeeder::class,
            EstadoTramiteSeeder::class,
            TipoArchivoSeeder::class,
            PermisoSeeder::class
        ]);
    }
}
