<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class RutaControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodRutaStore(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Ruta',[
            'nombre' => "Amor de Dios - Pampahasi",
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Ruta registrada correctamente',
                'code' => 201,
            ]);
    }
    public function testBadRutaStore(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Ruta',[
            //Empty JSON
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'nombre' => 
                array (
                    0 => 'El campo nombre es requerido',
                ),
            ]);
    }
    public function testGoodRutaIndex(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Ruta');

        $response
            ->assertStatus(200);
    }
    public function testBadRutaIndex(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 1',
        ])->get('/api/Ruta');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
                'code' => 401,
            ]);
    }
    public function testGoodRutaShow(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Ruta/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'ruta_id' => 1,
                'nombre' => 'Chasquipampa - San Pedro',
            ]);
    }
    public function testBadRutaShow(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Ruta/1000');

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Ruta not found',
                'code' => 404,
            ]);
    }
}
