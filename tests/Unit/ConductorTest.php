<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class ConductorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodStoreConductor(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor',[
            'nombres' => 'Diego Samuel',
            'ap_paterno' => 'Balderrama',
            'ap_materno' => 'Quino',
            'fecha_nacimiento' => '1997-12-10',
            'ci' => 4916388,
            'direccion' => 'Meseta de Achumani, Calle 1 No. 42',
            'celular' => 76744015,
            'telefono' => 2470014,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'Conductor registrado correctamente',
            ]);
    }
    public function testBadStoreConductor(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor',[
            'nombres' => 'Diego Samuel',
            'ap_paterno' => 'Balderrama',
            'ap_materno' => 'Quino',
            'fecha_nacimiento' => '1997-12-10',
            'ci' => 'AAH',
            'direccion' => 'Meseta de Achumani, Calle 1 No. 42',
            'celular' => 76744015,
            'telefono' => 2470014,
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'ci' => 
                array (
                    0 => 'El campo CI debe ser de tipo numérico',
                ),
            ]);
    }
    public function testGoodShowConductor(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer'.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'conductor_id' => 1,
                'nombres' => 'Diego Samuel',
                'ap_paterno' => 'Balderrama',
                'ap_materno' => 'Quino',
                'fecha_nacimiento' => '1997-12-10',
                'ci' => 4916388,
                'direccion' => 'Meseta de Achumani, Calle 1 No. 42',
                'celular' => 76744015,
                'telefono' => 2740014,
                'avatar' => 'default.jpg',
                'ruta_id' => 1,
                'next_punto_control' => null,
            ]);
    }
    public function testBadShowConductor(){
        //Bad Test
        $response = $this->get('/api/Conductor/1');
        $response
            ->assertJson([
                'message' => 'Unauthorized',
                'code' => 401,
            ]);
    }
    public function testGoodIndex(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor');
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

    public function GoodGetAvatar(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1');
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
                'code' => 401,
            ]);
    }
}
