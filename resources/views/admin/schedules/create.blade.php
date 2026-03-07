@extends('layouts.app')

@section('title', 'Добавить занятие')

@section('content')
<div class="container">
    <h2 class="mb-4">Добавить занятие</h2>

    @php
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
    @endphp

    <form action="{{ route('admin.schedules.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Предмет</label>
            <select name="subject_id" class="form-select">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Преподаватель</label>
            <select name="teacher_id" class="form-select">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" 
                        @if(request('teacher_id') == $teacher->id) selected @endif>
                        {{ $teacher->last_name }} {{ $teacher->first_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Аудитория</label>
            <select name="classroom_id" class="form-select">
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Корпус</label>
            <select name="building_id" class="form-select">
                @foreach($buildings as $building)
                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Период</label>
            <select name="period_id" class="form-select">
                @foreach($periods as $id => $time)
                    <option value="{{ $id }}">
                        {{ $id }} ({{ $time['start'] }}–{{ $time['end'] }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">День недели</label>
            <select name="day_of_week" class="form-select">
                @foreach($days as $eng => $rus)
                    <option value="{{ $eng }}">{{ $rus }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">Назад</a>
            <button type="submit" class="btn btn-success">Добавить</button>
        </div>
    </form>
</div>
@endsection
