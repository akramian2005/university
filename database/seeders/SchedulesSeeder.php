<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Schedule, Teacher, Classroom, Building, Period, Registration};

class SchedulesSeeder extends Seeder
{
    public function run(): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $buildings = Building::all();
        $periods = Period::all();

        foreach ($teachers as $teacher) {

            $subjects = Registration::where('teacher_id', $teacher->id)
                ->pluck('subject_id')
                ->unique();

            foreach ($subjects as $subjectId) {

                for ($i = 0; $i < rand(2, 3); $i++) {

                    Schedule::create([
                        'subject_id' => $subjectId,
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
}