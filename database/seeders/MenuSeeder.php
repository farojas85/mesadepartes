<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Role;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menu1 = Menu::firstOrCreate([
            'nombre' => 'Inicio',
            'enlace' => 'home',
            'imagen' => 'fas fa-home',
        ]);

        $menu2 = Menu::firstOrCreate([
            'nombre' => 'Sistema',
            'enlace' => 'sistema',
            'imagen' => 'fab fa-windows',
            'orden' => 1,
        ]);

        $menu3 = Menu::firstOrCreate([
            'nombre' => 'Configuración',
            'enlace' => 'configuracion',
            'imagen' => 'fas fa-cogs',
            'orden' => 2
        ]);

        $menu4 = Menu::firstOrCreate([
            'nombre' => 'Trámite',
            'enlace' => 'tramite',
            'imagen' => 'fas fa-file-invoice',
            'orden' => 3
        ]);

        $menu4 = Menu::firstOrCreate([
            'nombre' => 'Reporte',
            'enlace' => 'reporte',
            'imagen' => 'as fa-file-prescription',
            'orden' => 4
        ]);

        $role = Role::where('directriz','super-usuario')->first();

        $role->menus()->sync([$menu1->id,$menu2->id,$menu3->id,$menu4->id]);

    }
}
