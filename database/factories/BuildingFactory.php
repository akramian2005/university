<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Building;

class BuildingFactory extends Factory
{
    protected $model = Building::class;

    public function definition()
    {
        return [
            'name' => 'Building ' . $this->faker->unique()->randomElement(['A','B','C']),
        ];
    }
}
