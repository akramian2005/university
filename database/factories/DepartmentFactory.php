<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Faculty;
use Faker\Factory as FakerFactory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition()
    {
        $faker = FakerFactory::create('ru_RU');

        return [
            'name' => $faker->unique()->word, // слово на русском
            'faculty_id' => Faculty::inRandomOrder()->first()->id,
        ];
    }
}
