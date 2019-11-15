<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(App::environment() === 'production'){
            exit('No');
        }
        Eloquent::unguard();
        $tables = [
            'conductores',
            'conductor_vehiculo',
            'vehiculos',
            'rutas',
            'reportes',
            'puntos_ruta',
            'puntos',
            'tipo_puntos',
            'round_robinr',
            'current_assignation'
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach($tables as $table){
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->call('RutasSeeder');
        $this->call('ConductorSeeder');
        $this->call('VehiculoSeeder');
        $this->call('ConductorVehiculoSeeder');
        $this->call('TipoPuntoSeeder');
        $this->call('PuntoSeeder');
        $this->call('PuntoRutaSeeder');
    }
}
