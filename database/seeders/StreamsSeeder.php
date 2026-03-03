<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stream;
use App\Models\Subject;
use Illuminate\Support\Str;

class StreamsSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = Subject::all();

        foreach ($subjects as $subject) {

            // Берём название предмета без пробелов
            $baseName = Str::slug($subject->name, ' ');

            for ($i = 1; $i <= 3; $i++) {
                Stream::create([
                    'name' => $baseName . ' ' . $i,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}