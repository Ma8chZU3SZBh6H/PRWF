<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/products/recommended/kaunas');
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->where("city", "kaunas")
                ->has("recommendations", 3)
                ->whereType("recommendations.0.weather_forecast", "string")
                ->has("recommendations.0.products", 2)
                ->whereType("recommendations.0.products.0.name", "string")
                ->etc()
        );
        $response->assertStatus(200);
    }
}
