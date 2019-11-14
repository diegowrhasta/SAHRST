<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class PuntoControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodStorePunto(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Punto',[
            'nombre' =>  'Calle BOAH, Zona Julio Patiño',
	        'tipo_punto_id' =>  1,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Punto registrado correctamente',
                'code' => 201,
            ]);
    }
    public function testBadStorePunto(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Punto',[
            //Empty json
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'nombre' => 
                array (
                    0 => 'El campo nombre es requerido',
                ),
                'tipo_punto_id' =>
                array(
                    0 => 'El campo tipo_punto_id debe es requerido',
                )
            ]);
    }
    public function testGoodIndex(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Punto');
        $response
            ->assertStatus(200);
    }

    public function testBadIndex(){
        //Good Test
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 1',
        ])->get('/api/Punto');
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
                'code' => 401,
            ]);
    }
    public function testGoodShowPunto(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Punto/8');

        $response
            ->assertStatus(200)
            ->assertJson([
                'punto_id' => 8,
                'nombre' => 'Calle I, Zona Inca-Llojeta',
                'tipo_punto_id' => 1
            ]);
    }
    public function testBadShowPunto(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Punto/1000');
        $response
            ->assertJson([
                'message' => 'Punto no encontrado',
                'code' => 404
            ]);
    }
}
