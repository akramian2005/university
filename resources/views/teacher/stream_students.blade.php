@extends('layouts.app')

@section('title', 'Студенты потока')

@section('content')
<div class="container">
    <h2>Студенты потока: {{ $stream->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Студент (ID)</th>
                <th>История оценок</th>
                <th>Итог</th>
                <th>Выставить новую</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
                @php
                    $total = $registration->grades->sum('grade');
                    if ($total <= 60) $result = 'н/у';
                    elseif ($total <= 73) $result = 'удов';
                    elseif ($total <= 86) $result = 'хор';
                    else $result = 'отл';
                @endphp
                <tr>
                    <td>
                        <strong>{{ $registration->student->first_name }} {{ $registration->student->last_name }}</strong><br>
                        <small class="text-muted">ID: {{ $registration->student->id }}</small>
                    </td>
                    <td>
                        @forelse($registration->grades as $grade)
                            <div>
                                <code>{{ $grade->grade_date->format('d.m.Y') }}</code> 
                                — {{ ucfirst($grade->type) }}: <strong>{{ $grade->grade }}</strong>
                            </div>
                        @empty
                            <span class="text-muted">Оценок пока нет</span>
                        @endforelse
                    </td>
                    <td>
                        <strong>{{ $total }}</strong> баллов<br>
                        <span class="badge bg-info">{{ $result }}</span>
                    </td>
                    <td>
                        <form action="{{ route('teacher.grades.store') }}" method="POST" class="border p-2 bg-light">
                            @csrf
                            <input type="hidden" name="registration_id" value="{{ $registration->id }}">

                            <div class="mb-1">
                                <select name="type" class="form-select form-select-sm" required>
                                    <option value="">Выберите период</option>
                                    <option value="module1">Модуль 1 (макс 30)</option>
                                    <option value="module2">Модуль 2 (макс 30)</option>
                                    <option value="final">Итоговый контроль (макс 40)</option>
                                </select>
                            </div>

                            <div class="row g-1 mb-1">
                                <div class="col-4">
                                    <input type="number" name="grade" placeholder="Балл" class="form-control form-control-sm" required min="0" max="100">
                                </div>
                                <div class="col-8">
                                    <input type="date" name="grade_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm w-100">Сохранить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('teacher.streams') }}" class="btn btn-secondary">Назад к потокам</a>
</div>
@endsection
