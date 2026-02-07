<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Faculty;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition()
    {
        return [
            'name' => 'Department ' . $this->faker->unique()->word,
            'faculty_id' => Faculty::inRandomOrder()->first()->id,
        ];
    }
}
