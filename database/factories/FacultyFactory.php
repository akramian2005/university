<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Faculty;
use Faker\Factory as FakerFactory;

class FacultyFactory extends Factory
{
    protected $model = Faculty::class;

    public function definition()
    {
        $faker = FakerFactory::create('ru_RU');

        return [
            'name' => $faker->unique()->word, // слово на русском
        ];
    }
}
