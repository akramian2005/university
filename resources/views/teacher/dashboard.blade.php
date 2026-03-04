@extends('layouts.app')

@section('title', 'Панель преподавателя')

@section('content')
<div class="container">

    <div class="mb-4 text-center">
        <h2>Добро пожаловать, {{ $teacher->first_name }} {{ $teacher->last_name }}</h2>
        <p class="text-muted">Ваш идентификатор: {{ $teacher->id }}</p>
    </div>

    <div class="row">

        <!-- Мои дисциплины -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">Мои дисциплины</h5>
                        <p class="text-muted">Просмотр закреплённых предметов</p>
                    </div>
                    <a href="{{ route('teacher.subjects') }}" 
                       class="btn btn-primary mt-3">
                        Открыть
                    </a>
                </div>
            </div>
        </div>

        <!-- Моё расписание -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">Моё расписание</h5>
                        <p class="text-muted">Просмотр расписания занятий</p>
                    </div>
                    <a href="{{ route('teacher.schedule') }}" 
                       class="btn btn-warning mt-3">
                        Посмотреть
                    </a>
                </div>
            </div>
        </div>

                <!-- Мои потоки -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">Мои потоки</h5>
                        <p class="text-muted">Просмотр потоков, по которым вы ведёте предметы</p>
                    </div>
                    <a href="{{ route('teacher.streams') }}" 
                       class="btn btn-info mt-3">
                        Открыть потоки
                    </a>
                </div>
            </div>
        </div>

        <!-- Профиль -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">Профиль</h5>
                        <p class="text-muted">Просмотр вашей личной информации</p>
                    </div>
                    <a href="{{ route('teacher.profile') }}" 
                       class="btn btn-success mt-3">
                        Открыть профиль
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection