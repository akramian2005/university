@extends('layouts.app')

@section('content')
<h2>Welcome, {{ $student->first_name }} {{ $student->last_name }}</h2>
<p>Your ID: {{ $student->id }}</p>
@endsection
