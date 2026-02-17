@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ $teacher->first_name }} {{ $teacher->last_name }}</h2>
    <p>Your ID: {{ $teacher->id }}</p>
    <h4>Your Subjects:</h4>

    

    <!-- Кнопка перехода на страницу с предметами -->
    <a href="{{ route('teacher.subjects') }}" class="btn btn-primary">
        View My Subjects
    </a>
</div>
@endsection
