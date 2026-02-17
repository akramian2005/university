<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::guard('teacher')->user();

        // Получаем все предметы, которые ведет учитель, с потоками
        // $subjects = $teacher->subjects()->with('streams')->get();

        return view('teacher.dashboard', compact('teacher'));
    }

    // app/Http/Controllers/TeacherController.php

    public function mySubjects()
    {
        $teacher = auth()->guard('teacher')->user();

        // Получаем все предметы, которые ведёт учитель
        $subjects = $teacher->subjects()->with('streams')->get();

        return view('teacher.subjects', compact('teacher', 'subjects'));
    }

}
