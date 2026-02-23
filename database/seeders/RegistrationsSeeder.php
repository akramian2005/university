<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Registration, Student, Subject, Stream, Semester};

class RegistrationsSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $subjects = Subject::with(['streams', 'teachers'])->get();
        $semesters = Semester::all();

        foreach ($students as $student) {

            // студент выбирает случайный семестр
            $semester = $semesters->random();

            // студент регистрируется на 3–6 предметов
            $chosenSubjects = $subjects->random(rand(3, 6));

            foreach ($chosenSubjects as $subject) {

                if ($subject->streams->isEmpty() || $subject->teachers->isEmpty()) {
                    continue;
                }

                Registration::create([
                    'student_id' => $student->id,
                    'semester_id' => $semester->id,
                    'subject_id' => $subject->id,
                    'stream_id' => $subject->streams->random()->id,
                    'teacher_id' => $subject->teachers->random()->id,
                ]);
            }
        }
    }
}
