@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Control Panel</h1>

    @if(isset($tables) && count($tables) > 0)
        <h3>Tables:</h3>
        <ul>
            @foreach($tables as $table)
                <li>
                    <a href="{{ route('admin.table', $table) }}">
                        {{ ucfirst(str_replace('_', ' ', $table)) }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <hr>

    <h3>Quick access to panels:</h3>
    <ul>
        <li>
            <a href="{{ url('/admin') }}">Admin Panel</a>
        </li>
        <li>
            <a href="{{ url('/student') }}">Student Panel</a>
        </li>
        <li>
            <a href="{{ url('/teacher') }}">Teacher Panel</a>
        </li>
    </ul>
</div>
@endsection
