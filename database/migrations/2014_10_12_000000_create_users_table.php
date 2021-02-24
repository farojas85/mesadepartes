<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas');
            $table->string('usuario_codigo');
            $table->string('usuario_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('numero_celular',15)->nullable();
            $table->string('numero_anexo',15)->nullable();
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->foreignId('role_id')->constrained('roles');
            $table->string('foto')->nullable();
            $table->unsignedTinyInteger('estado')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
