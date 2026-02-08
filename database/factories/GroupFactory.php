<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;
use App\Models\Speciality;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->numberBetween(101, 9999),
            'speciality_id' => Speciality::inRandomOrder()->first()->id,
        ];
    }
}
