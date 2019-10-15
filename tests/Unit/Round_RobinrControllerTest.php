<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestingConstants;

class Round_RobinrControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodRoundRobinStart(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Round_Robinr/start',[
            'command' => "start",
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Route Started!',
                'code' => 201,
            ]);
    }
    public function testBadRoundRobinStart(){
        $testingConstantsClass = new TestingConstants;
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$testingConstantsClass->getTokenBearer(),
        ])->json('POST','/api/Round_Robinr/start',[
            'command' => "stop",
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'invalid command',
                'code' => 400,
            ]);
    }
    
}
