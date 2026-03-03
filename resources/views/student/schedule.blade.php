@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Моё расписание</h2>

    @php
        // Дни недели на русском
        $days = [
            'Monday' => 'Понедельник',
            'Tuesday' => 'Вторник',
            'Wednesday' => 'Среда',
            'Thursday' => 'Четверг',
            'Friday' => 'Пятница'
        ];

        // Пары с фиксированным временем
        $periods = [
            1 => ['start' => '10:00', 'end' => '11:20'],
            2 => ['start' => '11:30', 'end' => '12:50'],
            3 => ['start' => '13:00', 'end' => '14:20'],
            4 => ['start' => '15:00', 'end' => '16:20'],
            5 => ['start' => '16:30', 'end' => '17:50'],
            6 => ['start' => '18:00', 'end' => '19:20'],
        ];
    @endphp

    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>Время</th>
                @foreach($days as $dayEn => $dayRu)
                    <th>{{ $dayRu }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($periods as $p => $time)
                <tr>
                    <td><strong>{{ $time['start'] }} - {{ $time['end'] }}</strong></td>

                    @foreach($days as $dayEn => $dayRu)
                        <td>
                            @if(isset($schedules[$dayEn]))
                                @foreach($schedules[$dayEn] as $lesson)
                                    @if($lesson->period->id == $p)
                                        <strong>{{ $lesson->subject->name }}</strong><br>
                                        <small>{{ $lesson->teacher->first_name }} {{ $lesson->teacher->last_name }}</small><br>
                                        <small>{{ $lesson->building->name }} / {{ $lesson->classroom->name }}</small>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection