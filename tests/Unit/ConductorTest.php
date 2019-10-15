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
            'telefono' => 2740014,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'Conductor registrado correctamente',
                'code' => 202,
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
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
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
                'ruta_id' => null,
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

    public function testGoodGetAvatar(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1/profile_pic');
        $response
            ->assertStatus(200);
    }
    public function testBadGetAvatar(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1000/profile_pic');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Conductor not found',
                'code' => 404,
            ]);
    }
    public function testGoodGetCurrentRoute(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1/get_route');
        $response
            ->assertStatus(200);
    }
    public function testBadGetCurrentRoute(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1000/get_route');
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid number of routes or invalid conductor_id',
                'code' => 400,
            ]);
    }

    public function testGoodGetConductorsVehiculoByid(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1/Vehiculo/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                "vehiculo_id" => 1,
                "placa" => "3014-DHH",
                "modelo" => 2014,
                "marca" => "Nissan",
                "color" => "Naranja",
            ]);
    }
    public function testBadGetConductorsVehiculoByid(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1000/Vehiculo/1');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Conductor not found',
                'code' => 404,
            ]);
    }

    public function testGoodGetConductorsVehiclesList(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1/Vehiculo');
        $response
            ->assertStatus(200);
    }
    public function testBadGetConductorsVehiclesList(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1000/Vehiculo');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Conductor not found',
                'code' => 404,
            ]);
    }
    public function testGoodConductorsGetPuntoControl(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1/Punto_Control');
        $response
            ->assertStatus(200);
    }
    public function testBadConductorsGetPuntoControl(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->get('/api/Conductor/1000/Punto_Control');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Conductor invalid',
                'code' => 404,
            ]);
    }
    public function testGoodUpdate(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('PUT','/api/Conductor/1',[
            'nombres' => 'Diego Samuel',
            'ap_paterno' => 'Balderrama',
            'ap_materno' => 'Quino',
            'fecha_nacimiento' => '1997-12-10',
            'ci' => 4916388,
            'direccion' => 'Meseta de Achumani, Calle 1 No. 42',
            'celular' => 76744015,
            'telefono' => 2740014,
            'ruta_id' => null,
            'next_punto_control' => null,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                "Message" => "Edición exitosa",
                "Code" => 200,
            ]);
    }
    public function testBadUpdate(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('PUT','/api/Conductor/1',[
            'nombres' => 'Diego Samuel',
            'ap_paterno' => 'Balderrama',
            'ap_materno' => 'Quino',
            'fecha_nacimiento' => '1997-12-10',
            'ci' => "YIKES",
            'direccion' => 'Meseta de Achumani, Calle 1 No. 42',
            'celular' => "DAWG",
            'telefono' => 2740014,
            'ruta_id' => null,
            'next_punto_control' => null,
        ]);
        $response
            ->assertStatus(400)
            ->assertJson([
                'ci' => array (
                    "El campo CI debe ser de tipo numérico"
                ),
                'celular' => array (
                    "El número de celular debe ser numérico"
                )
            ]);
    }
    public function testGoodGoodPuntoControl(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor/1/isInCheckpoint',[
            'pass' => true,
        ]);
        $response
            ->assertStatus(202)
            ->assertJson([
                'message' => 'Punto de Control avanzado',
                'code' => 202,
            ]);
    }
    public function testBadGoodPuntoControl(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor/1/isInCheckpoint',[
            'pass' => 'yeboi',
        ]);
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Body not valid',
                'code' => 400,
            ]);
    }
    public function testGoodBadPuntoControl(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Conductor/1/Reportar',[
            'conductor_id' => 1,
        ]);
        $response
            ->assertStatus(202)
            ->assertJson([
                'message' => 'Reporte Registrado',
                'code' => 202,
            ]);
    }
    public function testBadBadPuntoControl(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
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
    public function testGoodDestroy(){
        //Good Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->delete('/api/Conductor/2');
        $response
            ->assertStatus(202)
            ->assertJson([
                'message' => 'Eliminación exitosa',
                'code' => 202,
            ]);
    }
    public function testBadDestroy(){
        //Bad Test
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->delete('/api/Conductor/1000');
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'invalid Conductor',
                'code' => 400,
            ]);
    }
}
