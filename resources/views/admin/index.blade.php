@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Panel</h1>
    <h3>Tables:</h3>
    <ul>
        @foreach($tables as $table)
            <li>
                <a href="{{ route('admin.table', $table) }}">{{ ucfirst($table) }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
