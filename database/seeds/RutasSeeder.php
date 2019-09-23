<?php

use App\Ruta;
use Illuminate\Database\Seeder;

class RutasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruta::create(["nombre" => "Zona Tejar - Zona Cota Cota"]);
        Ruta::create(["nombre" => "Zona Miraflores - Chasquipampa"]);
        Ruta::create(["nombre" => "Zona Chamoco Chico - Zona Ovejuyo"]);
    }
}
