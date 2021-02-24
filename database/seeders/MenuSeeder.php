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

        $role = Role::where('directriz','super-usuario')->first();

        $role->menus()->sync([$menu1->id,$menu2->id,$menu3->id]);

    }
}
