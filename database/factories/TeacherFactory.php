<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {
        // Возможные ставки
        $rates = [0.5, 1, 1.5];

        // Возможные должности
        $positions = [
            'Старший преподаватель',
            'Доцент',
            'Профессор',
        ];

        $rate = $this->faker->randomElement($rates);
        $position = $this->faker->randomElement($positions);

        // Расчет зарплаты
        $baseSalary = 30000; // 1 ставка
        $salary = $baseSalary * $rate;

        $positionBonus = match ($position) {
            'Старший преподаватель' => 1000,
            'Доцент' => 2000,
            'Профессор' => 3000,
            default => 0,
        };

        $salary += $positionBonus;

        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'address'    => $this->faker->address,
            'rate'       => $rate,
            'position'   => $position,
            'salary'     => $salary,          // сразу заполняем
            'password'   => Hash::make('Teacher123!'),
        ];
    }
}