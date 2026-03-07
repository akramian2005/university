@extends('layouts.app')

@section('title','Учителя')

@section('content')
<div class="container">
    <h2 class="mb-4">Список учителей</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="id" class="form-control" placeholder="ID" value="{{ request('id') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" placeholder="Имя/Фамилия" value="{{ request('name') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="position" class="form-control" placeholder="Должность" value="{{ request('position') }}">
                </div>
                <div class="col-md-2">
                    <select name="sort_column" class="form-select">
                        <option value="id" @selected(request('sort_column')=='id')>ID</option>
                        <option value="last_name" @selected(request('sort_column')=='last_name')>Фамилия</option>
                        <option value="first_name" @selected(request('sort_column')=='first_name')>Имя</option>
                        <option value="position" @selected(request('sort_column')=='position')>Должность</option>
                        <option value="rate" @selected(request('sort_column')=='rate')>Ставка</option>
                        <option value="salary" @selected(request('sort_column')=='salary')>Зарплата</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort_direction" class="form-select">
                        <option value="asc" @selected(request('sort_direction')=='asc')>↑ Возрастание</option>
                        <option value="desc" @selected(request('sort_direction')=='desc')>↓ Убывание</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex">
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary w-50 me-2">Сбросить</a>
                    <button type="submit" class="btn btn-primary w-50">Фильтровать</button>
                </div>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.teachers.create') }}" class="btn btn-success mb-3">+ Добавить учителя</a>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Должность</th>
                <th>Ставка</th>
                <th>Зарплата</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->last_name }} {{ $teacher->first_name }}</td>
                    <td>{{ $teacher->position }}</td>
                    <td>{{ $teacher->rate }}</td>
                    <td>{{ $teacher->salary }}</td>
                    <td class="d-flex justify-content-center gap-1">
                        <a href="{{ route('admin.teachers.show',$teacher->id) }}" class="btn btn-sm btn-info">Редактировать</a>
                        <form action="{{ route('admin.teachers.destroy',$teacher->id) }}" method="POST" onsubmit="return confirm('Удалить учителя?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $teachers->links() }}
</div>
@endsection
