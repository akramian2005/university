@extends('layouts.app')

@section('title', 'Панель управления')

@section('content')
<h2 class="mb-4 text-center">Панель управления</h2>

{{-- Таблицы --}}
@if(isset($tables) && count($tables) > 0)
    <h4 class="mb-3 text-center">Управление таблицами</h4>

    <div class="row justify-content-center">
        @foreach($tables as $table)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title text-primary">
                                {{ ucfirst(str_replace('_', ' ', $table)) }}
                            </h5>
                            <p class="text-muted small">
                                Просмотр и редактирование данных
                            </p>
                        </div>

                        <a href="{{ route('admin.table', $table) }}" 
                           class="btn btn-outline-primary mt-3">
                            Открыть таблицу
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<hr class="my-3">

{{-- Выбор роли --}}
<h4 class="mb-4 text-center">Выбор роли</h4>

<div class="d-flex flex-column align-items-center gap-2">
    <a href="{{ url('/admin') }}" class="btn btn-primary btn-lg w-25">Администратор</a>
    <a href="{{ url('/student') }}" class="btn btn-primary btn-lg w-25">Студент</a>
    <a href="{{ url('/teacher') }}" class="btn btn-primary btn-lg w-25">Преподаватель</a>
</div>
@endsection