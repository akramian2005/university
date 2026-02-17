<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Year;
use Carbon\Carbon;

class YearsTableSeeder extends Seeder
{
    public function run(): void
    {
        $currentYear = Carbon::now()->year;

        for ($i = 0; $i < 5; $i++) {
            Year::create(['year' => $currentYear + $i]);
        }
    }
}
