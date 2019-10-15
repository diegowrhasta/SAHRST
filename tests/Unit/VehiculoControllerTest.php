<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class VehiculoControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodVehiculoStore(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Vehiculo',[
            "placa" =>  "525-THK",
            "modelo" =>  2007,
            "marca" =>  "Isuzu",
            "color" =>  "Guindo"
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Vehiculo registrado correctamente',
                'code' => 201,
            ]);
    }
    public function testBadVehiculoStore(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Vehiculo',[
            //Empty JSON
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'placa' => 
                array (
                    0 => 'El campo de placa es requerido',
                ),
                'modelo' => 
                array (
                    0 => 'El campo modelo es requerido',
                ),
                'marca' => 
                array (
                    0 => 'El campo de marca es requerido',
                ),
                'color' => 
                array (
                    0 => 'El campo de color es requerido',
                ),
            ]);
    }
    public function testGoodVehiculoIndex(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Vehiculo');

        $response
            ->assertStatus(200);
    }
    public function testBadVehiculoIndex(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 1',
        ])->get('/api/Vehiculo');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
                'code' => 401,
            ]);
    }
    public function testGoodVehiculoShow(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Vehiculo/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "vehiculo_id" =>  1,
                "placa" =>  "3014-DHH",
                "modelo" =>  2014,
                "marca" =>  "Nissan",
                "color" =>  "Naranja"
            ]);
    }
    public function testBadVehiculoShow(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Vehiculo/1000');

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Vehiculo not found',
                'code' => 404,
            ]);
    }
    public function testGoodVehiculoUpdate(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('PUT','/api/Vehiculo/2',[
            "placa" =>  "525-THK",
            "modelo" =>  2007,
            "marca" =>  "Isuzu",
            "color" =>  "Guindo",
        ]);
        $response
            ->assertStatus(201)
            ->assertJson([
                "message" => "vehiculo updated",
                "code" => 201,
            ]);
    }
    public function testBadVehiculoUpdate(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('PUT','/api/Vehiculo/2',[
            "placa" =>  "525-THK",
            "color" =>  "Guindo",
        ]);
        $response
            ->assertStatus(400)
            ->assertJson([
                'modelo' => array (
                    "El campo modelo es requerido"
                ),
                'marca' => array (
                    "El campo de marca es requerido"
                )
            ]);
    }
    public function testGoodVehiculoDestroy(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->delete('/api/Vehiculo/3');

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'vehiculo deleted',
                'code' => 201,
            ]);
    }
    public function testBadVehiculoDestroy(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->delete('/api/Vehiculo/1000');

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'vehiculo not found',
                'code' => 404,
            ]);
    }
}
