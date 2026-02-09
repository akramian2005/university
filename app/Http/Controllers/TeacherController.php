<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.dashboard', compact('teacher'));
    }
}
