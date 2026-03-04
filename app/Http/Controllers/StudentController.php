<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // 🔹 Dashboard
    public function dashboard()
    {
        $student = Auth::guard('student')->user();

        return view('student.dashboard', compact('student'));
    }

    // 🔹 Профиль
    public function profile()
    {
        $student = Auth::guard('student')->user();

        return view('student.profile', compact('student'));
    }


    public function grades()
    {
        $student = Auth::guard('student')->user();

        $registrations = Registration::where('student_id', $student->id)
            ->with([
                'subject',
                'stream',
                'teacher', 
                'grades' => function ($q) {
                    $q->orderBy('grade_date');
                }
            ])
            ->get();

        return view('student.grades', compact('registrations', 'student'));
    }
}