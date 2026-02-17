@extends('layouts.app')

@section('content')
<h2>My Registrations</h2>

@if($registrations->isEmpty())
    <p>You have no registrations yet.</p>
@else
    @php
        // Группируем регистрации по семестрам
        $registrationsBySemester = $registrations->groupBy(fn($reg) => $reg->semester->name);
    @endphp

    @foreach($registrationsBySemester as $semesterName => $semesterRegs)
        <h3>{{ $semesterName }}</h3>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Stream</th>
                    <th>Teacher</th>
                </tr>
            </thead>
            <tbody>
                @foreach($semesterRegs as $reg)
                    <tr>
                        <td>{{ $reg->subject->name }}</td>
                        <td>{{ $reg->stream->name }}</td>
                        <td>{{ $reg->teacher->first_name }} {{ $reg->teacher->last_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endif
@endsection
