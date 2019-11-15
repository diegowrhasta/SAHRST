<?php

use App\Vehiculo;
use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
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
            Vehiculo::create([
                'placa' => $faker -> numberBetween(1000,9999) . ' - ' . $faker -> word,
                'modelo' => $faker -> year,
                'marca' => $faker -> company,
                'color' => $faker -> colorName,
            ]);
        }
    }
}
