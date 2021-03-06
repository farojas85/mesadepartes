<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('anio');
            $table->string('codigo_tramite',20);
            $table->foreignId('tipo_tramite_id')->nullable()->constrained('tipo_tramites');
            //$table->string('sumilla',255);
            $table->unsignedInteger('numero_folios');
            $table->text('asunto');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('estado_tramite_id')->nullable()->constrained('estado_tramites');
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
        Schema::dropIfExists('tramites');
    }
}
