<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class Tipo_PuntoControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodTipo_PuntoStore(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Tipo_Punto',[
            'nombre' => "Inicio",
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Tipo_Punto registrado correctamente',
                'code' => 201,
            ]);
    }
    public function testBadTipo_PuntoStore(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Tipo_Punto',[
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
    public function testGoodTipo_PuntoIndex(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Tipo_Punto');

        $response
            ->assertStatus(200);
    }
    public function testBadTipo_PuntoIndex(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 1',
        ])->get('/api/Tipo_Punto');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
                'code' => 401,
            ]);
    }
    public function testGoodTipo_PuntoShow(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Tipo_Punto/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'tipo_punto_id' => 1,
                'nombre' => 'Inicio',
            ]);
    }
    public function testBadTipo_PuntoShow(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Tipo_Punto/1000');

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Tipo_Punto not found',
                'code' => 404,
            ]);
    }
}
