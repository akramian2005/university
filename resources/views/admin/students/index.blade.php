@extends('layouts.app')

@section('title', 'Студенты')

@section('content')
<div class="container">
    <h2 class="mb-4">Список студентов</h2>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Группа</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
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
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }}
</div>
@endsection