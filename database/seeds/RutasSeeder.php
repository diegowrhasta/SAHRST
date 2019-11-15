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
        $faker = Faker\Factory::create();
        for($i=0;$i<5;$i++){
            Ruta::create([
                'nombre' => $faker -> streetName . ' - ' . $faker -> streetName 
            ]);
        }
    }
}
