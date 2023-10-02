<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $flight = Flight::inRandomOrder()->first()->id;
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'flight_id' => $flight,
            'page_id' => $user->page->id,
            'user_email' => $user->email,
            'page_name' => $user->page->name,
        ];
    }
}
