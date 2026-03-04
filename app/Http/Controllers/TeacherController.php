<?php

namespace App\Http\Controllers;

use App\Models\{Stream, Registration, Grade};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $teacher = Auth::guard('teacher')->user();

        return view('teacher.dashboard', compact('teacher'));
    }

    // Мои предметы
    public function mySubjects()
    {
        $teacher = Auth::guard('teacher')->user();

        $subjects = $teacher->subjects()->with('streams')->get();

        return view('teacher.subjects', compact('teacher', 'subjects'));
    }

    // Профиль
    public function profile()
    {
        $teacher = Auth::guard('teacher')->user();

        return view('teacher.profile', compact('teacher'));
    }

    // 🔹 Потоки учителя (через registrations)
    public function streams()
    {
        $teacher = Auth::guard('teacher')->user();

        $streams = Stream::whereHas('registrations', function ($q) use ($teacher) {
            $q->where('teacher_id', $teacher->id);
        })->with('subject')->get();

        return view('teacher.streams', compact('streams'));
    }

    // 🔹 Студенты конкретного потока
    public function streamStudents($streamId)
    {
        $teacher = Auth::guard('teacher')->user();

        // Проверка: поток действительно принадлежит учителю
        $stream = Stream::whereHas('registrations', function ($q) use ($teacher, $streamId) {
            $q->where('teacher_id', $teacher->id)
              ->where('stream_id', $streamId);
        })->firstOrFail();

        $registrations = Registration::where('stream_id', $streamId)
            ->where('teacher_id', $teacher->id)
            ->with(['student', 'grades'])
            ->get();

        return view('teacher.stream_students', compact('registrations', 'stream'));
    }

    // 🔹 Сохранение оценки
    public function storeGrade(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'grade_date' => 'required|date',
            'grade' => 'required|integer|min:0|max:100',
            'comment' => 'nullable|string'
        ]);

        $teacher = Auth::guard('teacher')->user();

        // Проверяем что регистрация принадлежит этому учителю
        $registration = Registration::where('id', $request->registration_id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        Grade::create([
            'registration_id' => $registration->id,
            'grade_date' => $request->grade_date,
            'grade' => $request->grade,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Оценка выставлена');
    }
}