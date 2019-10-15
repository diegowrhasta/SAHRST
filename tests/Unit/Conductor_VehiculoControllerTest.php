<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class Conductor_VehiculoControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodStoreConductor_Vehiculo(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor_Vehiculo',[
            'vehiculo_id' => 2,
            'conductor_id' => 3,
        ]);

        $response
            ->assertStatus(202)
            ->assertJson([
                'message' => 'Conductor_Vehiculo registrado exitosamente',
                'code' => 202,
            ]);
    }
    public function testBadStoreConductor_Vehiculo(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor_Vehiculo',[
            'vehiculo_id' => 2,
            'conductor_id' => 1000,
        ]);

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Conductor not found',
                'code' => 404,
            ]);
    }
}
