<?php

use App\Punto_Ruta;
use Illuminate\Database\Seeder;

class PuntoRutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $j = 1;
        for($i=1;$i<=3;$i++){
            Punto_Ruta::create([
                'punto_id' => $i,
                'ruta_id' => $i,
                'posicion' => $j,
            ]);
            Punto_Ruta::create([
                'punto_id' => $i+5,
                'ruta_id' => $i,
                'posicion' => $j+1,
            ]);
            Punto_Ruta::create([
                'punto_id' => $i+10,
                'ruta_id' => $i,
                'posicion' => $j+2,
            ]);
        }
    }
}
