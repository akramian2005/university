@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Мои регистрации</h2>

    @if($registrations->isEmpty())
        <div class="alert alert-info">У вас пока нет регистраций.</div>
    @else
        @php
            // Группируем регистрации по семестрам
            $registrationsBySemester = $registrations->groupBy(fn($reg) => $reg->semester->name);
        @endphp

        @foreach($registrationsBySemester as $semesterName => $semesterRegs)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ $semesterName }}
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Дисциплина</th>
                                <th>Поток</th>
                                <th>Преподаватель</th>
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
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection