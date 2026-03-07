@extends('layouts.app')

@section('title', 'Расписание')

@section('content')
<div class="container">
    <h2 class="mb-4">Расписание по преподавателям</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-2">
            <input type="text" name="teacher" class="form-control" placeholder="Преподаватель" value="{{ request('teacher') }}">
        </div>
        <div class="col-md-2">
            <select name="day_of_week" class="form-select">
                <option value="">Все дни</option>
                @foreach($days as $eng => $rus)
                    <option value="{{ $eng }}" @selected(request('day_of_week') == $eng)>{{ $rus }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="period_id" class="form-select">
                <option value="">Все периоды</option>
                @foreach($periods as $id => $time)
                    <option value="{{ $id }}" @selected(request('period_id') == $id)>
                        {{ $id }} ({{ $time['start'] }}–{{ $time['end'] }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" name="subject_id" class="form-control" placeholder="ID предмета" value="{{ request('subject_id') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="classroom_id" class="form-control" placeholder="ID аудитории" value="{{ request('classroom_id') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="building_id" class="form-control" placeholder="ID корпуса" value="{{ request('building_id') }}">
        </div>
        <div class="col-md-2">
            <select name="sort_column" class="form-select">
                <option value="day_of_week" @selected(request('sort_column')=='day_of_week')>День недели</option>
                <option value="period_id" @selected(request('sort_column')=='period_id')>Период</option>
                <option value="subject_id" @selected(request('sort_column')=='subject_id')>Предмет</option>
                <option value="classroom_id" @selected(request('sort_column')=='classroom_id')>Аудитория</option>
                <option value="building_id" @selected(request('sort_column')=='building_id')>Корпус</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="sort_direction" class="form-select">
                <option value="asc" @selected(request('sort_direction')=='asc')>↑ Возрастание</option>
                <option value="desc" @selected(request('sort_direction')=='desc')>↓ Убывание</option>
            </select>
        </div>
        <div class="col-md-3 d-flex">
            <button type="submit" class="btn btn-primary w-50 me-2">Фильтровать</button>
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary w-50">Сбросить</a>
        </div>
    </form>

    @forelse($schedules as $teacherId => $teacherSchedules)
        @php $teacher = $teacherSchedules->first()->teacher; @endphp

        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                <span>
                    {{ $teacher->last_name }} {{ $teacher->first_name }}
                    <small class="text-light">(ID: {{ $teacher->id }})</small>
                </span>
                <a href="{{ route('admin.schedules.create', ['teacher_id' => $teacher->id]) }}" class="btn btn-light btn-sm">
                    + Добавить занятие
                </a>
            </div>
            <div class="card-body p-0">
                @foreach($days as $eng => $rus)
                    @php $daySchedules = $teacherSchedules->where('day_of_week',$eng); @endphp
                    @if($daySchedules->count())
                        <h6 class="bg-light p-2 mb-0">{{ $rus }}</h6>
                        <table class="table table-bordered mb-3 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Предмет</th>
                                    <th>Аудитория</th>
                                    <th>Корпус</th>
                                    <th>Период</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($daySchedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->subject->name }}</td>
                                        <td>{{ $schedule->classroom->name }}</td>
                                        <td>{{ $schedule->building->name }}</td>
                                        <td>
                                            {{ $schedule->period_id }} 
                                            ({{ $periods[$schedule->period_id]['start'] }}–{{ $periods[$schedule->period_id]['end'] }})
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-sm btn-primary">Редактировать</a>
                                            <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить запись?')">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-muted">Расписание не найдено</p>
    @endforelse
</div>
@endsection
