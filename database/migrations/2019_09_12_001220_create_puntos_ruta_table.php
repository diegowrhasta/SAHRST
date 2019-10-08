<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntosRutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos_ruta', function (Blueprint $table) {
            $table->bigIncrements('punto_ruta_id');
            $table->bigInteger('punto_id')->unsigned()->nullable();
            $table->foreign('punto_id')->references('punto_id')->on('puntos');
            $table->bigInteger('ruta_id')->unsigned()->nullable();
            $table->foreign('ruta_id')->references('ruta_id')->on('rutas');
            $table->integer('posicion');
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
        Schema::dropIfExists('puntos_ruta');
    }
}
