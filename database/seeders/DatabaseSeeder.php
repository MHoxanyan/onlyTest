<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\ComfortLevel;
use App\Models\Driver;
use App\Models\Position;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Driver::factory(10)->create();
        Car::factory(10)->create();
    }
}
