<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogin()
    {
        //Good Test
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST','/api/auth/login',[
            'email' => 'diegojefe@gmail.com',
            "password" => 'jefe'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'token_type' => 'Bearer',
            ]);

        //Bad Test
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST','/api/auth/login',[
            'email' => 'diegojefe@gmail.com',
            "password" => 'yeet'
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
            ]);
    }
}
