<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Subject;

class SubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();

        foreach ($subjects as $subject) {
            // случайные 3 учителя для каждого предмета
            $assigned = $teachers->shuffle()->take(3);
            $subject->teachers()->sync($assigned->pluck('id')->toArray());
        }
    }
}
