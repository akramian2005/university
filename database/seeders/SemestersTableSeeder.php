<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemestersTableSeeder extends Seeder
{
    public function run(): void
    {
        Semester::create([
            'name' => 'Осенний',
            'start_month' => 9,  // Сентябрь
            'end_month' => 12,   // Декабрь
        ]);

        Semester::create([
            'name' => 'Весенний',
            'start_month' => 2,  // Февраль
            'end_month' => 6,    // Июнь
        ]);
    }
}
