<?php

use App\Punto;
use Illuminate\Database\Seeder;

class PuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=0;$i<5;$i++){
            Punto::create([
                'nombre' => 'Calle ' . $faker -> streetName . ', Zona ' . $faker -> streetName,
                'tipo_punto_id' => 1
            ]);
        }
        for($i=0;$i<5;$i++){
            Punto::create([
                'nombre' => 'Calle ' . $faker -> streetName . ', Zona ' . $faker -> streetName,
                'tipo_punto_id' => 2
            ]);
        }
        for($i=0;$i<5;$i++){
            Punto::create([
                'nombre' => 'Calle ' . $faker -> streetName . ', Zona ' . $faker -> streetName,
                'tipo_punto_id' => 3
            ]);
        }
    }
}
