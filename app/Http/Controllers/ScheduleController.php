<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    // Расписание студента
    public function student()
    {
        $student = Auth::guard('student')->user();

        $schedules = Schedule::whereHas('subject.registrations', function ($q) use ($student) {
            $q->where('student_id', $student->id);
        })
        ->with(['subject', 'teacher', 'classroom', 'building', 'period'])
        ->get()
        ->groupBy('day_of_week');

        return view('student.schedule', compact('schedules'));
    }

    // Расписание учителя
    public function teacher()
    {
        $teacher = Auth::guard('teacher')->user();

        $schedules = Schedule::where('teacher_id', $teacher->id)
            ->with(['subject', 'classroom', 'building', 'period'])
            ->get()
            ->groupBy('day_of_week');

        return view('teacher.schedule', compact('schedules'));
    }
}
