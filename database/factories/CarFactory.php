<?php

namespace Database\Factories;

use App\Models\ComfortLevel;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->text('10'),
            'model' => $this->faker->text('10'),
            'title' => $this->faker->title,
            'driver_id' => Driver::factory(),
            'comfort_level_id' => ComfortLevel::factory(),
        ];
    }
}
