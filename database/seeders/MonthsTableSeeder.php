<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Month;

class MonthsTableSeeder extends Seeder
{
    public function run(): void
    {
        $months = [
            ['name' => 'Январь', 'number' => 1],
            ['name' => 'Февраль', 'number' => 2],
            ['name' => 'Март', 'number' => 3],
            ['name' => 'Апрель', 'number' => 4],
            ['name' => 'Май', 'number' => 5],
            ['name' => 'Июнь', 'number' => 6],
            ['name' => 'Июль', 'number' => 7],
            ['name' => 'Август', 'number' => 8],
            ['name' => 'Сентябрь', 'number' => 9],
            ['name' => 'Октябрь', 'number' => 10],
            ['name' => 'Ноябрь', 'number' => 11],
            ['name' => 'Декабрь', 'number' => 12],
        ];

        foreach ($months as $month) {
            Month::create($month);
        }
    }
}
