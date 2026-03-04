@extends('layouts.app')

@section('title', 'Панель студента')

@section('content')
<div class="container">

    <div class="mb-4">
        <h2>Добро пожаловать, {{ $student->first_name }} {{ $student->last_name }}</h2>
        <p class="text-muted">Ваш идентификатор: {{ $student->id }}</p>
    </div>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Личный кабинет</h5>
                    <p class="text-muted">Посмотреть всю информацию о себе</p>
                    <a href="{{ route('student.profile') }}" 
                       class="btn btn-info">
                        Перейти
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Регистрация на дисциплины</h5>
                    <p class="text-muted">Записаться на новые предметы</p>
                    <a href="{{ route('registrations.create') }}" 
                       class="btn btn-primary">
                        Перейти
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Мои регистрации</h5>
                    <p class="text-muted">Просмотр выбранных дисциплин</p>
                    <a href="{{ route('student.registrations') }}" 
                       class="btn btn-success">
                        Открыть
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Моё расписание</h5>
                    <p class="text-muted">Просмотр расписания занятий</p>
                    <a href="{{ route('student.schedule') }}" 
                       class="btn btn-warning">
                        Посмотреть
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection