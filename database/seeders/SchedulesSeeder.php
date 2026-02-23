<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Schedule, Subject, Teacher, Classroom, Building, Period};

class SchedulesSeeder extends Seeder
{
    public function run(): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        $subjects = Subject::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $buildings = Building::all();
        $periods = Period::all();

        foreach ($teachers as $teacher) {

            for ($i = 0; $i < rand(4, 8); $i++) {

                Schedule::create([
                    'subject_id' => $subjects->random()->id,
                    'teacher_id' => $teacher->id,
                    'classroom_id' => $classrooms->random()->id,
                    'building_id' => $buildings->random()->id,
                    'period_id' => $periods->random()->id,
                    'day_of_week' => $days[array_rand($days)],
                ]);
            }
        }

    }
}
