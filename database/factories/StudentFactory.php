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
use Faker\Factory as FakerFactory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        // создаём faker с русской локалью
        $faker = FakerFactory::create('ru_RU');

        $contract_price = $faker->numberBetween(60000, 100000);
        $contract_paid = $faker->numberBetween(0, $contract_price);

        return [
            'first_name'       => $faker->firstName,   // русские имена
            'last_name'        => $faker->lastName,    // русские фамилии
            'date_born'        => $faker->date(),
            'gender_id'        => Gender::inRandomOrder()->first()->id,
            'region_id'        => Region::inRandomOrder()->first()->id,
            'nationality_id'   => Nationality::inRandomOrder()->first()->id,
            'group_id'         => Group::inRandomOrder()->first()->id,
            'form_of_study_id' => FormOfStudy::inRandomOrder()->first()->id,
            'study_mode_id'    => StudyMode::inRandomOrder()->first()->id,
            'password'         => Hash::make('Student123!'),
            'contract_price'   => $contract_price,
            'contract_paid'    => $contract_paid,
        ];
    }
}
