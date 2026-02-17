<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Gender;
use App\Models\Region;
use App\Models\Nationality;
use App\Models\Group;
use App\Models\FormOfStudy;
use App\Models\StudyMode;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'date_born' => $this->faker->date(),
            'gender_id' => Gender::inRandomOrder()->first()->id,
            'region_id' => Region::inRandomOrder()->first()->id,
            'nationality_id' => Nationality::inRandomOrder()->first()->id,
            'group_id' => Group::inRandomOrder()->first()->id,
            'form_of_study_id' => FormOfStudy::inRandomOrder()->first()->id,
            'study_mode_id' => StudyMode::inRandomOrder()->first()->id,
            'password' => Hash::make('student123'),
        ];
    }
}
