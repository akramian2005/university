@extends('layouts.app')

@section('title', 'Студенты потока')

@section('content')
<div class="container">
    <h2>Студенты потока: {{ $stream->name }}</h2>

    {{-- Вывод сообщения об успехе --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Студент</th>
                <th>История оценок</th>
                <th>Действие (Выставить новую)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
                <tr>
                    <td>
                        <strong>{{ $registration->student->first_name }} {{ $registration->student->last_name }}</strong>
                    </td>
                    <td>
                        <small>
                            @forelse($registration->grades as $grade)
                                <div>
                                    <code>{{ $grade->grade_date->format('d.m.Y') }}</code>: 
                                    <strong>{{ $grade->grade }}</strong> 
                                    @if($grade->comment) <span class="text-muted">({{ $grade->comment }})</span> @endif
                                </div>
                            @empty
                                <span class="text-muted">Оценок пока нет</span>
                            @endforelse
                        </small>
                    </td>
                    <td>
                        {{-- Путь роута исправлен на teacher.grades.store --}}
                        <form action="{{ route('teacher.grades.store') }}" method="POST" class="border p-2 bg-light">
                            @csrf
                            <input type="hidden" name="registration_id" value="{{ $registration->id }}">
                            
                            <div class="row g-1">
                                <div class="col-4">
                                    <input type="number" name="grade" placeholder="Балл" class="form-control form-control-sm" required min="0" max="100">
                                </div>
                                <div class="col-8">
                                    <input type="date" name="grade_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <input type="text" name="comment" placeholder="Комментарий" class="form-control form-control-sm mt-1">
                            <button type="submit" class="btn btn-success btn-sm w-100 mt-1">Сохранить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('teacher.streams') }}" class="btn btn-secondary">Назад к потокам</a>
</div>
@endsection