@extends('layouts.app')

@section('content')
<h2>Welcome, {{ $teacher->first_name }} {{ $teacher->last_name }}</h2>
<p>Your ID: {{ $teacher->id }}</p>
@endsection
