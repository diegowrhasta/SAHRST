<?php

use App\Tipo_Punto;
use Illuminate\Database\Seeder;

class TipoPuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo_Punto::create(["nombre" => "Inicio"]);
        Tipo_Punto::create(["nombre" => "Final"]);
        Tipo_Punto::create(["nombre" => "Control"]);
    }
}
