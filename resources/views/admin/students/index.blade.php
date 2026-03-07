@extends('layouts.app')

@section('title', 'Студенты')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Список студентов</h2>
        <a href="{{ route('admin.students.create') }}" class="btn btn-success">
            + Добавить студента
        </a>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.students.index') }}" method="GET" class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="search_id" class="form-control" placeholder="Поиск по ID" value="{{ request('search_id') }}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="search_name" class="form-control" placeholder="Поиск по имени или фамилии" value="{{ request('search_name') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Найти</button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Группа</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->group->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.students.show', $student->id) }}"
                           class="btn btn-sm btn-primary">
                            Открыть
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-muted">Студенты не найдены</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $students->links() }}
    </div>
</div>
@endsection
