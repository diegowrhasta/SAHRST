<?php

use App\Conductor;
use Illuminate\Database\Seeder;

class ConductorSeeder extends Seeder
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
            if($i==0){
                Conductor::create([
                    'nombres' => 'Diego Samuel Balderrama Quino',
                    'ap_paterno' => $faker -> lastName,
                    'ap_materno' => $faker -> lastName,
                    'fecha_nacimiento' => $faker -> dateTimeBetween('-40 years', '-18 years'),
                    'ci' => $faker -> numberBetween(1000000,9999999),
                    'direccion' => $faker -> address,
                    'celular' => $faker -> numberBetween(10000000,99999999),
                    'telefono' => $faker -> numberBetween(10000000,99999999),
                    'ruta_id' => 1,
                    'next_punto_control' => 6
                ]);    
                continue;
            }
            Conductor::create([
                'nombres' => $faker -> name,
                'ap_paterno' => $faker -> lastName,
                'ap_materno' => $faker -> lastName,
                'fecha_nacimiento' => $faker -> dateTimeBetween('-40 years', '-18 years'),
                'ci' => $faker -> numberBetween(1000000,9999999),
                'direccion' => $faker -> address,
                'celular' => $faker -> numberBetween(10000000,99999999),
                'telefono' => $faker -> numberBetween(10000000,99999999)
            ]);
        }
    }
}
