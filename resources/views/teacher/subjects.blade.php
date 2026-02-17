<!-- resources/views/teacher/subjects.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Subjects</h2>
    <p>Teacher: {{ $teacher->first_name }} {{ $teacher->last_name }} (ID: {{ $teacher->id }})</p>

    @if($subjects->isEmpty())
        <p>No subjects assigned yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Streams</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>
                            @if($subject->streams->isEmpty())
                                None
                            @else
                                <ul>
                                    @foreach($subject->streams as $stream)
                                        <li>{{ $stream->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


@endsection
