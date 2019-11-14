<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class Punto_RutaControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodStorePunto_Ruta(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Punto_Ruta',[
            'punto_id' => 3,
            'ruta_id' => 1,
            'posicion' => 1,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Punto_Ruta registrado correctamente',
                'code' => 201,
            ]);
    }
    public function testBadStorePunto_Ruta(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Punto_Ruta',[
            'ruta_id' => 3,
            'posicion' => 3,
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'punto_id' => 
                array (
                    0 => 'El campo punto_id es requerido',
                ),
            ]);
    }
    public function testGoodIndex(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Punto_Ruta');
        $response
            ->assertStatus(200);
    }

    public function testBadIndex(){
        //Good Test
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 1',
        ])->get('/api/Conductor');
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
                'code' => 401,
            ]);
    }

    public function testGoodDestroy(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->delete('/api/Punto_Ruta/15');
        $response
            ->assertStatus(201)
            ->assertJson([
                'message' =>'Relación eliminada',
                'code' => 201
            ]);
    }
    public function testBadDestroy(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->delete('/api/Punto_Ruta/1');
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' =>'Relación inexistente',
                'code' => 400
            ]);
    }
}
