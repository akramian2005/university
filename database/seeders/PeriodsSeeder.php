<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Period;

class PeriodsSeeder extends Seeder
{
    public function run(): void
    {
        $periods = [
            ['name' => '1 Pair', 'start_time' => '10:00', 'end_time' => '11:20'],
            ['name' => '2 Pair', 'start_time' => '11:30', 'end_time' => '12:50'],
            ['name' => '3 Pair', 'start_time' => '13:00', 'end_time' => '14:20'],
            ['name' => '4 Pair', 'start_time' => '15:00', 'end_time' => '16:20'],
            ['name' => '5 Pair', 'start_time' => '16:30', 'end_time' => '17:50'],
            ['name' => '6 Pair', 'start_time' => '18:00', 'end_time' => '19:20'],
        ];

        foreach ($periods as $period) {
            Period::create($period);
        }
    }
}
