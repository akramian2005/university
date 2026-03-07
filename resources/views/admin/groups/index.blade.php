@extends('layouts.app')

@section('title', 'Группы')

@section('content')
<div class="container">
    <h2 class="mb-4">Список групп</h2>

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
                    <input type="text" name="name" class="form-control" placeholder="Название" value="{{ request('name') }}">
                </div>
                <div class="col-md-3">
                    <select name="speciality_id" class="form-select">
                        <option value="">Все специальности</option>
                        @foreach($specialities as $speciality)
                            <option value="{{ $speciality->id }}" @selected(request('speciality_id')==$speciality->id)>
                                {{ $speciality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="students_count" class="form-control" placeholder="Кол-во студентов" value="{{ request('students_count') }}">
                </div>
                <div class="col-md-2">
                    <select name="sort_column" class="form-select">
                        <option value="id" @selected(request('sort_column')=='id')>ID</option>
                        <option value="name" @selected(request('sort_column')=='name')>Название</option>
                        <option value="speciality_id" @selected(request('sort_column')=='speciality_id')>Специальность</option>
                        <option value="students_count" @selected(request('sort_column')=='students_count')>Студентов</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort_direction" class="form-select">
                        <option value="asc" @selected(request('sort_direction')=='asc')>↑ Возрастание</option>
                        <option value="desc" @selected(request('sort_direction')=='desc')>↓ Убывание</option>
                    </select>
                </div>
                    <div class="col-md-4 d-flex">
                        <a href="{{ route('admin.groups.index') }}" class="btn btn-secondary w-50 me-2">Сбросить</a>
                        <button type="submit" class="btn btn-primary w-50">Фильтровать</button>
                    </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Специальность</th>
                <th>Студентов</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->speciality->name ?? '—' }}</td>
                    <td>{{ $group->students_count }}</td>
                    <td class="d-flex justify-content-center gap-1">
                        <a href="{{ route('admin.groups.show', $group->id) }}" class="btn btn-sm btn-info">Состав</a>
                        <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-sm btn-primary">Редактировать</a>
                        <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Вы уверены, что хотите удалить эту группу?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $groups->links() }}
    </div>
</div>
@endsection
