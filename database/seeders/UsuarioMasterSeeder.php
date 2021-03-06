<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Persona;
use App\Models\Role;
use App\Models\Cargo;
use App\Models\TipoDocumento;
class UsuarioMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargo = Cargo::select('id')->where('nombre','DIRECTOR DE SISTEMA ADMINISTRATIVO')->first();
        $rol = Role::select('id')->where('directriz','super-usuario')->first();
        $tipodoc = TipoDocumento::select('id')->where('nombre','DNI/LE')->first();

        $persona = Persona::firstOrCreate([
            'tipodocumento_id' => $tipodoc->id,
            'numero_documento' => '73984764',
            'nombres' => 'BILL KENEDIN',
            'apellido_paterno' => 'VASQUEZ',
            'apellido_materno' => 'FIRMA',
            'correo_personal' => 'bill.vasquez.by@gmail.com',
            'sexo' => 'M'
        ]);

        $user = User::firstOrCreate([
            'persona_id' => $persona->id,
            'usuario_codigo' => '73984764',
            'usuario_email' => 'bill.vasquez.by@gmail.com',
            'password' =>  Hash::make('73984764'),
            'cargo_id' => $cargo->id,
            'role_id' => $rol->id,
            'foto' => 'user_varon.png',
            'estado' => 1
        ]);
    }
}
