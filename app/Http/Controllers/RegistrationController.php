<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Stream;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    // Форма регистрации
    public function create()
    {
        $subjects = Subject::all();
        $semesters = Semester::all();
        return view('registrations.create', compact('subjects', 'semesters'));
    }

    // Сохраняем регистрацию
    public function store(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:subjects,id',
            'stream_id' => 'required|exists:streams,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Registration::create([
            'student_id' => Auth::id(),
            'semester_id' => $request->semester_id,
            'subject_id' => $request->subject_id,
            'stream_id' => $request->stream_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }

    // AJAX: получить потоки для предмета
    public function getStreams(Request $request)
    {
        $streams = Stream::where('subject_id', $request->subject_id)->get();
        return response()->json($streams);
    }

    // AJAX: получить учителей для предмета
    public function getTeachers(Request $request)
    {
        $subject = Subject::findOrFail($request->subject_id);
        $teachers = $subject->teachers; // связь многие ко многим
        return response()->json($teachers);
    }

        public function student()
    {
        $student = Auth::guard('student')->user();

        // Получаем все регистрации текущего студента с предметом, потоком, учителем и семестром
        $registrations = Registration::with(['subject', 'stream', 'teacher', 'semester'])
            ->where('student_id', $student->id)
            ->get();

        return view('student.registrations', compact('student', 'registrations'));
    }
}
