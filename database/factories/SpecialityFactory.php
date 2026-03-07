<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Speciality;
use App\Models\Department;
use Faker\Factory as FakerFactory;

class SpecialityFactory extends Factory
{
    protected $model = Speciality::class;

    public function definition()
    {
        // создаём faker с русской локалью
        $faker = FakerFactory::create('ru_RU');

        return [
            'name' => $faker->unique()->word, // слово на русском
            'department_id' => Department::inRandomOrder()->first()->id,
        ];
    }
}
