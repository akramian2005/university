@extends('layouts.app')

@section('title', 'Административная панель')

@section('content')
<h2 class="mb-4">Административная панель</h2>

<div class="row">


    {{-- Кнопка для администрирования студентов --}}
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between text-center">
                <div>
                    <h5 class="card-title text-primary">Студенты</h5>
                    <p class="text-muted">Просмотр и редактирование студентов</p>
                </div>
                <a href="{{ route('admin.students.index') }}" 
                   class="btn btn-outline-success mt-3">
                    Открыть студентов
                </a>
            </div>
        </div>
    </div>


    {{-- Кнопка для администрирования групп --}}
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between text-center">
                <div>
                    <h5 class="card-title text-primary">Группы</h5>
                    <p class="text-muted">Просмотр всех групп и их состава</p>
                </div>
                <a href="{{ route('admin.groups.index') }}" class="btn btn-outline-success mt-3">
                    Открыть группы
                </a>
            </div>
        </div>
    </div>

    {{-- Кнопка для администрирования расписания --}}
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between text-center">
                <div>
                    <h5 class="card-title text-primary">Расписание</h5>
                    <p class="text-muted">Просмотр и редактирование расписания занятий</p>
                </div>
                <a href="{{ route('admin.schedules.index') }}" 
                class="btn btn-outline-success mt-3">
                    Открыть расписание
                </a>
            </div>
        </div>
    </div>


    @php
        $tableNames = [
            'teachers' => 'Преподаватели',
            'subjects' => 'Дисциплины',
            'classrooms' => 'Аудитории',
            'streams' => 'Потоки',
            'subject_teacher' => 'Преподаватели-дисциплины',
            'registrations' => 'Регистрации',
        ];
    @endphp

    @foreach($tables as $table)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h5 class="card-title text-primary">
                            {{ $tableNames[$table] ?? ucfirst($table) }}
                        </h5>
                        <p class="card-text text-muted">
                            Управление данными таблицы "{{ $tableNames[$table] ?? ucfirst($table) }}"
                        </p>
                    </div>

                    <a href="{{ route('admin.table', $table) }}" 
                    class="btn btn-outline-success mt-3">
                        Открыть
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection