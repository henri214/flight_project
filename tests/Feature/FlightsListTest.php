<?php

namespace Tests\Feature;

use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightsListTest extends TestCase
{
    public function test_flights_list_returns_paginated_data_correctly(): void
    {
        Flight::factory(16)->create();
        $response = $this->get('/api/flights');

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data');
    }
}
