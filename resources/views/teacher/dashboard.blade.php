@extends('layouts.app')

@section('title', 'Панель преподавателя')

@section('content')
<div class="container">

    <div class="mb-4">
        <h2>Добро пожаловать, {{ $teacher->first_name }} {{ $teacher->last_name }}</h2>
        <p class="text-muted">Ваш идентификатор: {{ $teacher->id }}</p>
    </div>

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Мои дисциплины</h5>
                    <p class="text-muted">Просмотр закреплённых предметов</p>
                    <a href="{{ route('teacher.subjects') }}" 
                       class="btn btn-primary">
                        Открыть
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Моё расписание</h5>
                    <p class="text-muted">Просмотр расписания занятий</p>
                    <a href="{{ route('teacher.schedule') }}" 
                       class="btn btn-warning">
                        Посмотреть
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection