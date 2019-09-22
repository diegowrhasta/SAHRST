<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = ['diego', 'yawar', 'christian'];
        $aux = 0;
        for ($i = 0; $i < 6;$i++){
            if( $i % 2 == 0){
                User::create([
                    'name' => $usuarios[$aux],
                    'email' => $usuarios[$aux]."jefe@gmail.com",
                    'type' => "jefe",
                    'password' => Hash::make('jefe'),
                ]);
            }
            else{
                User::create([
                    'name' => $usuarios[$aux],
                    'email' => $usuarios[$aux]."encargado@gmail.com",
                    'type' => "encargado",
                    'password' => Hash::make('encargado'),
                ]);
                $aux++;
            }

        }
    }
}
