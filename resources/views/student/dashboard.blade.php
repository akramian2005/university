@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ $student->first_name }} {{ $student->last_name }}</h2>
    <p>Your ID: {{ $student->id }}</p>

    <a href="{{ route('registrations.create') }}" class="btn btn-primary mt-3">
        Register for Courses
    </a>

    <a href="{{ route('student.registrations') }}" class="btn btn-primary mt-3">
        View My Registrations
    </a>
</div>
@endsection
