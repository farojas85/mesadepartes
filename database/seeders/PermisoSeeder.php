<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permiso;
use App\Models\Role;
class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::select('id')->where('directriz','super-usuario')->first();
        // 'nombre','directriz','descripcion'
        $permiso1 = Permiso::firstOrCreate([
            'nombre' => 'Vista Rol','directriz' => 'roles.inicio','descripcion' => 'Vista Inicio Rol.'
        ])
        ;
        $permiso2 = Permiso::firstOrCreate([
            'nombre' => 'Crear Rol','directriz' => 'roles.crear','descripcion' => 'Añadir Nuevo Rol.'
        ])
        ;
        $permiso3 = Permiso::firstOrCreate([
            'nombre' => 'Editar Rol','directriz' => 'roles.editar','descripcion' => 'Editar Datos de Rol Seleccionado.'
        ])
        ;
        $permiso4 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Rol','directriz' => 'roles.eliminar','descripcion' => 'Eliminar Registro de Rol Seleccionado.'
        ])
        ;
        $permiso5 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Rol','directriz' => 'roles.restaurar','descripcion' => 'Restaurar Registro de Rol Seleccionado.'
        ])
        ;

        $permiso6 = Permiso::firstOrCreate([
            'nombre' => 'Vista Usuario','directriz' => 'usuarios.inicio','descripcion' => 'Vista Inicio Usuario.'
        ])
        ;
        $permiso7 = Permiso::firstOrCreate([
            'nombre' => 'Crear Usuario','directriz' => 'usuarios.crear','descripcion' => 'Añadir Nuevo Usuario.'
        ])
        ;
        $permiso8 = Permiso::firstOrCreate([
            'nombre' => 'Editar Usuario','directriz' => 'usuarios.editar','descripcion' => 'Editar Datos de Usuario Seleccionado.'
        ])
        ;
        $permiso9 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Usuario','directriz' => 'usuarios.eliminar','descripcion' => 'Eliminar Registro de Usuario Seleccionado.'
        ])
        ;
        $permiso10 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Usuario','directriz' => 'usuarios.restaurar','descripcion' => 'Restaurar Registro de Usuario Seleccionado.'
        ])
        ;

        $permiso11 = Permiso::firstOrCreate([
            'nombre' => 'Vista Permiso','directriz' => 'permisos.inicio','descripcion' => 'Vista Inicio Permiso.'
        ])
        ;
        $permiso12 = Permiso::firstOrCreate([
            'nombre' => 'Crear Permiso','directriz' => 'permisos.crear','descripcion' => 'Añadir Nuevo Permiso.'
        ])
        ;
        $permiso13 = Permiso::firstOrCreate([
            'nombre' => 'Editar Permiso','directriz' => 'permisos.editar','descripcion' => 'Editar Datos de Permiso Seleccionado.'
        ])
        ;
        $permiso14 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Permiso','directriz' => 'permisos.eliminar','descripcion' => 'Eliminar Registro de Permiso Seleccionado.'
        ])
        ;
        $permiso15 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Permiso','directriz' => 'permisos.restaurar','descripcion' => 'Restaurar Registro de Permiso Seleccionado.'
        ])
        ;

        $permiso16 = Permiso::firstOrCreate([
            'nombre' => 'Vista Permiso/Role','directriz' => 'permiso-role.inicio','descripcion' => 'Vista Inicio Permiso/Role.'
        ])
        ;
        $permiso17 = Permiso::firstOrCreate([
            'nombre' => 'Guardar Permiso/Role','directriz' => 'permiso-role.guardar','descripcion' => 'Añadir Nuevo Permiso/Role.'
        ])
        ;

        $permiso18 = Permiso::firstOrCreate([
            'nombre' => 'Vista Menú','directriz' => 'menus.inicio','descripcion' => 'Vista Inicio Menú.'
        ])
        ;
        $permiso19 = Permiso::firstOrCreate([
            'nombre' => 'Crear Menú','directriz' => 'menus.crear','descripcion' => 'Añadir Nuevo Menú.'
        ])
        ;
        $permiso20 = Permiso::firstOrCreate([
            'nombre' => 'Editar Menú','directriz' => 'menus.editar','descripcion' => 'Editar Datos de Menú Seleccionado.'
        ])
        ;
        $permiso21 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Menú','directriz' => 'menus.eliminar','descripcion' => 'Eliminar Registro de Menú Seleccionado.'
        ])
        ;
        $permiso22 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Menú','directriz' => 'menus.restaurar','descripcion' => 'Restaurar Registro de Menú Seleccionado.'
        ])
        ;

        $permiso23 = Permiso::firstOrCreate([
            'nombre' => 'Vista Menú/Roles','directriz' => 'menu-role.inicio','descripcion' => 'Vista Inicio Menú/Roles.'
        ])
        ;
        $permiso24 = Permiso::firstOrCreate([
            'nombre' => 'Guardar Menú/Roles','directriz' => 'menu-role.guardar','descripcion' => 'Guardar Menú/Roles.'
        ])
        ;

        $permiso25 = Permiso::firstOrCreate([
            'nombre' => 'Vista Trámite','directriz' => 'tramites.inicio','descripcion' => 'Vista Inicio Trámite'
        ])
        ;
        $permiso26 = Permiso::firstOrCreate([
            'nombre' => 'Crear Trámite','directriz' => 'tramites.crear','descripcion' => 'Añadir Nuevo Trámite'
        ])
        ;
        $permiso27 = Permiso::firstOrCreate([
            'nombre' => 'Editar Trámite','directriz' => 'tramites.editar','descripcion' => 'Editar Datos de Trámite Seleccionado'
        ])
        ;
        $permiso28 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Trámite','directriz' => 'tramites.eliminar','descripcion' => 'Eliminar Registro de Trámite Seleccionado'
        ])
        ;
        $permiso29 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Trámite','directriz' => 'tramites.restaurar','descripcion' => 'Restaurar Registro de Trámite Seleccionado'
        ])
        ;
        $permiso30 = Permiso::firstOrCreate([
            'nombre' => 'Trámite Movimientos','directriz' => 'tramites.movimientos','descripcion' => 'Ver Movimientos del Trámite Seleccionado'
        ])
        ;

        $role1->permisos()->sync([
            $permiso1->id, $permiso2->id,$permiso3->id,$permiso4->id,$permiso5->id,$permiso6->id,$permiso7->id,$permiso8->id,$permiso9->id,$permiso10->id,
            $permiso11->id, $permiso12->id,$permiso13->id,$permiso14->id,$permiso15->id,$permiso16->id,$permiso17->id,$permiso18->id,$permiso19->id,$permiso20->id,
            $permiso21->id, $permiso22->id,$permiso23->id,$permiso24->id,$permiso25->id,$permiso26->id,$permiso27->id,$permiso28->id,$permiso29->id,$permiso30->id
        ]);
    }
}
