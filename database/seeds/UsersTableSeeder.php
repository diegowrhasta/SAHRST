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
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 3;$i++){
            $type = '';
            if( $i == 0)
                $type = 'jefe';
            else
                $type = 'encargado';
            User::create([
                'username' => $faker->name,
                'email' => $faker->email,
                'type' => $type,
                'password' => Hash::make('user'),
            ]);
        }
    }
}
