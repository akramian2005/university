<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Speciality;
use App\Models\Department;

class SpecialityFactory extends Factory
{
    protected $model = Speciality::class;

    public function definition()
    {
        return [
            'name' => 'Speciality ' . $this->faker->unique()->word,
            'department_id' => Department::inRandomOrder()->first()->id,
        ];
    }
}
