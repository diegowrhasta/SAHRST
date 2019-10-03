<?php

use App\Round_RobinR;
use Illuminate\Database\Seeder;

class NextRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Round_RobinR::create([
            'next_ruta_id' => 1
        ]);
    }
}
