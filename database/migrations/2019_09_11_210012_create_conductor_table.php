<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductores', function (Blueprint $table) {
            $table->bigIncrements('conductor_id');
            $table->string('nombres');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->date('fecha_nacimiento');
            $table->integer('ci');
            $table->string('direccion');
            $table->integer('celular');
            $table->integer('telefono');
            $table->bigInteger('ruta_id')->unsigned()->nullable();
            $table->foreign('ruta_id')->references('ruta_id')->on('rutas');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductor');
    }
}
