<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class ReporteControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodStore(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor/1/Reportar',[
            'conductor_id' => 1,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Reporte Registrado',
                'code' => 201,
            ]);
    }
    public function testBadStore(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor/1/Reportar',[
            'conductor_id' => 2,
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Body not valid',
                'code' => 400,
            ]);
    }
}
