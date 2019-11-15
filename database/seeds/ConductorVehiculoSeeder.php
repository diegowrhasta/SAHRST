<?php

use App\Conductor_Vehiculo;
use Illuminate\Database\Seeder;

class ConductorVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=1;$i<=5;$i++){
            Conductor_Vehiculo::create([
                'conductor_id' => $i,
                'vehiculo_id' => $i
            ]);
        }
    }
}
