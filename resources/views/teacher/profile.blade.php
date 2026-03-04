@extends('layouts.app')

@section('title', 'Профиль преподавателя')

@section('content')
<div class="container">
    <h2 class="mb-4">Профиль: {{ $teacher->first_name }} {{ $teacher->last_name }}</h2>

    <div class="card shadow-sm p-4">
        <h5 class="mb-3">Основная информация</h5>
        <table class="table table-bordered">
            <tr>
                <th>ФИО</th>
                <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
            </tr>
            <tr>
                <th>Адрес</th>
                <td>{{ $teacher->address }}</td>
            </tr>

            <tr>
                <th>Должность</th>
                <td>{{ $teacher->position }}</td>
            </tr>
            <tr>
                <th>Ставка</th>
                <td>{{ $teacher->rate }}</td>
            </tr>
            <tr>
                <th>Зарплата</th>
                <td>{{ number_format($teacher->salary, 0, '', ' ') }} сом</td>
            </tr>
        </table>
    </div>
</div>
@endsection