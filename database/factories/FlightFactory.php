<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Airline;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nr = rand(1, 365);
        $date = Carbon::now()->addDays($nr);
        $date2 = Carbon::parse($date)->addHours(rand(1, 23));
        $date3 = Carbon::parse($date)->addDays(rand(1, 60));
        $date4 = Carbon::parse($date3)->addHours(rand(1, 23));
        $two_way = $this->faker->boolean(20);
        $countryFrom = fake()->country();
        $countryTo = fake()->country();
        return [
            'name' => $countryFrom,
            'country_to' => ($countryTo !== $countryFrom) ? $countryTo : fake()->country(),
            'airline_id' => Airline::factory(),
            'departure_time' => $date,
            'arrival_time' => $date2,
            'two_way' => $two_way,
            'two_way_departure_time' => $two_way ? $date3 : null,
            'two_way_arrival_time' => $two_way ? $date4 : null,
            'price' => fake()->randomFloat('', 10, 2000),
            'pasangers' => fake()->randomFloat('', 100, 200),
            'is_available' => fake()->boolean(95),

        ];
    }
}
