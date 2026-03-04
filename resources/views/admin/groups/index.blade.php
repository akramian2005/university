@extends('layouts.app')

@section('title', 'Группы')

@section('content')
<div class="container">
    <h2 class="mb-4">Список групп</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Специальность</th>
                <th>Студентов</th> <!-- новая колонка -->
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->speciality->name ?? '—' }}</td>
                    <td>{{ $group->students_count }}</td> <!-- вывод количества студентов -->
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

    <!-- Пагинация -->
    <div class="mt-3">
        {{ $groups->links() }}
    </div>
</div>
@endsection