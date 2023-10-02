<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Airline;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Airline::factory(5)->hasFlights(4)->create();
        Page::factory(10)->hasUsers(3)->create();
        Booking::factory(30)->create();
        Role::factory()->create([
            'name' => 'admin',
        ]);
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'birthday' => now(),
            'phone' => '+123345565',
            'gender' => 'male',
            'password' => '12345678',
            'role_id' => 1,
        ]);
    }
}
