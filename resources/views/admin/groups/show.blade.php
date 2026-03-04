@extends('layouts.app')

@section('title', 'Состав группы')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Группа: {{ $group->name }}</h2>
    <p class="text-center text-muted">
        Студентов в группе: {{ $group->students->count() }}
    </p>

    @if($group->students->isEmpty())
        <p class="text-center text-muted">В группе пока нет студентов.</p>
    @else
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Группа</th>
                    <th>Настройка</th>
                </tr>
            </thead>
            <tbody>
                @foreach($group->students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $group->name }}</td>
                        <td>
                            <a href="{{ route('admin.students.show', $student->id) }}"
                               class="btn btn-sm btn-primary">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection