<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sede_id')->nullable();
            $table->foreign('sede_id')->on('sedes')->references('id')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->on('areas')->references('id')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('subarea_id')->nullable();
            $table->foreign('subarea_id')->on('subareas')->references('id')
                            ->onUpdate('cascade');
            $table->string('nombre');
            $table->unsignedTinyInteger('estado')->default(1);
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
        Schema::dropIfExists('cargos');
    }
}
