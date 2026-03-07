<?php

namespace App\Http\Controllers;

use App\Models\{Stream, Registration, Grade};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // Панель управления
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

    // Потоки учителя
    public function streams()
    {
        $teacher = Auth::guard('teacher')->user();

        $streams = Stream::whereHas('registrations', function ($q) use ($teacher) {
            $q->where('teacher_id', $teacher->id);
        })->with('subject')->get();

        return view('teacher.streams', compact('streams'));
    }

    // Студенты конкретного потока
    public function streamStudents($streamId)
    {
        $teacher = Auth::guard('teacher')->user();

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

    // Сохранение оценки
    public function storeGrade(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'grade_date' => 'required|date',
            'type' => 'required|in:module1,module2,final',
            'grade' => 'required|integer|min:0|max:100',
        ]);

        $teacher = Auth::guard('teacher')->user();

        $registration = Registration::where('id', $request->registration_id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        // Ограничения по компонентам
        $maxScores = [
            'module1' => 30,
            'module2' => 30,
            'final'   => 40,
        ];

        if ($request->grade > $maxScores[$request->type]) {
            return back()->withErrors([
                'grade' => 'Максимум для '.$request->type.' — '.$maxScores[$request->type].' баллов'
            ]);
        }

        Grade::create([
            'registration_id' => $registration->id,
            'grade_date' => $request->grade_date,
            'type' => $request->type,
            'grade' => $request->grade,
        ]);

        return back()->with('success', 'Оценка выставлена');
    }
}
