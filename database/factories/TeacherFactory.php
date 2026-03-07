<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as FakerFactory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {
        // создаём faker с русской локалью
        $faker = FakerFactory::create('ru_RU');

        $rates = [0.5, 1, 1.5];
        $positions = [
            'Старший преподаватель',
            'Доцент',
            'Профессор',
        ];

        $rate = $faker->randomElement($rates);
        $position = $faker->randomElement($positions);

        $baseSalary = 30000;
        $salary = $baseSalary * $rate;

        $positionBonus = match ($position) {
            'Старший преподаватель' => 1000,
            'Доцент' => 2000,
            'Профессор' => 3000,
            default => 0,
        };

        $salary += $positionBonus;

        return [
            'first_name' => $faker->firstName,   // русские имена
            'last_name'  => $faker->lastName,    // русские фамилии
            'address'    => $faker->address,     // адреса на русском
            'rate'       => $rate,
            'position'   => $position,
            'salary'     => $salary,
            'password'   => Hash::make('Teacher123!'),
        ];
    }
}
