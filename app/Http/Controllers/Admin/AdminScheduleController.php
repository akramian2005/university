<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Building;

class AdminScheduleController extends Controller
{
    // Список расписаний (группировка по преподавателям)
public function index(Request $request)
{
    $query = Schedule::with(['subject','teacher','classroom','building']);

    if ($request->filled('teacher')) {
        $query->whereHas('teacher', function($q) use ($request) {
            $q->where('last_name','like',"%{$request->teacher}%")
              ->orWhere('first_name','like',"%{$request->teacher}%");
        });
    }

    if ($request->filled('day_of_week')) {
        $query->where('day_of_week', $request->day_of_week);
    }

    if ($request->filled('period_id')) {
        $query->where('period_id', $request->period_id);
    }

    if ($request->filled('subject_id')) {
        $query->where('subject_id', $request->subject_id);
    }

    $schedules = $query->get()->groupBy('teacher_id');

    $days = [
        'Monday' => 'Понедельник',
        'Tuesday' => 'Вторник',
        'Wednesday' => 'Среда',
        'Thursday' => 'Четверг',
        'Friday' => 'Пятница',
    ];

    $periods = [
        1 => ['start' => '10:00', 'end' => '11:20'],
        2 => ['start' => '11:30', 'end' => '12:50'],
        3 => ['start' => '13:00', 'end' => '14:20'],
        4 => ['start' => '15:00', 'end' => '16:20'],
        5 => ['start' => '16:30', 'end' => '17:50'],
        6 => ['start' => '18:00', 'end' => '19:20'],
    ];

    return view('admin.schedules.index', compact('schedules','days','periods'));
}


    public function create()
    {
        return view('admin.schedules.create', [
            'subjects' => Subject::all(),
            'teachers' => Teacher::all(),
            'classrooms' => Classroom::all(),
            'buildings' => Building::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'building_id' => 'required|exists:buildings,id',
            'period_id' => 'required|integer|min:1|max:6',
            'day_of_week' => 'required|string',
        ]);

        Schedule::create($data);

        return redirect()->route('admin.schedules.index')->with('success','Занятие добавлено');
    }

    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', [
            'schedule' => $schedule,
            'subjects' => Subject::all(),
            'teachers' => Teacher::all(),
            'classrooms' => Classroom::all(),
            'buildings' => Building::all(),
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'building_id' => 'required|exists:buildings,id',
            'period_id' => 'required|integer|min:1|max:6',
            'day_of_week' => 'required|string',
        ]);

        $schedule->update($data);

        return redirect()->route('admin.schedules.index')->with('success','Расписание обновлено');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back()->with('success','Запись удалена');
    }
}
