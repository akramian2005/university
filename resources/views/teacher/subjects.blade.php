<!-- resources/views/teacher/subjects.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Мои предметы</h2>
    <p>Преподаватель: <strong>{{ $teacher->first_name }} {{ $teacher->last_name }}</strong> (ID: {{ $teacher->id }})</p>

    @if($subjects->isEmpty())
        <div class="alert alert-info mt-3">У вас пока нет назначенных предметов.</div>
    @else
        <div class="row">
            @foreach($subjects as $subject)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white">
                            {{ $subject->name }}
                        </div>
                        <div class="card-body">
                            <h6>Потоки:</h6>
                            @if($subject->streams->isEmpty())
                                <p>Нет потоков</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($subject->streams as $stream)
                                        <li class="list-group-item">{{ $stream->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection