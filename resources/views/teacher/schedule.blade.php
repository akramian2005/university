@extends('layouts.app')

@section('content')
<h2>My Teaching Schedule</h2>

@php
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// Пары с временем
$periods = [
    1 => '10:00 - 11:20',
    2 => '11:30 - 12:50',
    3 => '13:00 - 14:20',
    4 => '15:00 - 16:20',
    5 => '16:30 - 17:50',
    6 => '18:00 - 19:20',
];
@endphp

<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>Pair</th>
            @foreach($days as $day)
                <th>{{ $day }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($periods as $p => $time)
            <tr>
                <td><strong>{{ $time }}</strong></td>

                @foreach($days as $day)
                    <td>
                        @if(isset($schedules[$day]))
                            @foreach($schedules[$day] as $lesson)
                                @if($lesson->period->id == $p)
                                    <strong>{{ $lesson->subject->name }}</strong><br>
                                    {{ $lesson->building->name }} /
                                    {{ $lesson->classroom->name }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@endsection