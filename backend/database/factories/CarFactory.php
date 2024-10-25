<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use App\Enums\CarAvailabilityEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;
    
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'model' => fake()->year(),
            'price' => fake()->randomFloat(2,10000,500000),
            'user_id' => User::factory(),
            'availability' => fake()->randomElement(CarAvailabilityEnum::toValues()),
        ];
    }
}
