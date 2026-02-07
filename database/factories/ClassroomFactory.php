<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classroom;
use App\Models\Building;

class ClassroomFactory extends Factory
{
    protected $model = Classroom::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->numberBetween(101, 200),
            'building_id' => Building::inRandomOrder()->first()->id,
        ];
    }
}
