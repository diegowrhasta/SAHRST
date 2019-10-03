<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductorVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductor_vehiculo', function (Blueprint $table) {
            $table->bigIncrements('conductor_vehiculo_id');
            $table->bigInteger('conductor_id')->unsigned()->nullable();
            $table->foreign('conductor_id')->references('conductor_id')->on('conductores');
            $table->bigInteger('vehiculo_id')->unsigned()->nullable();
            $table->foreign('vehiculo_id')->references('vehiculo_id')->on('vehiculos');
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
        Schema::dropIfExists('conductor_vehiculo');
    }
}
