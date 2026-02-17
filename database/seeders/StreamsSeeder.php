<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Stream;
use App\Models\Subject;

class StreamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            for ($i = 1; $i <= 3; $i++) {
                Stream::create([
                    'name' => 'Stream ' . $i,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}

