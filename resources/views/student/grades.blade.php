@extends('layouts.app')

@section('title', 'Мои оценки')

@section('content')
<div class="container">
    <h2 class="mb-4">Успеваемость по предметам</h2>
    
    <table class="table table-hover table-bordered mt-3">
        <thead class="table-dark text-center">
            <tr>
                <th>Предмет / Поток</th>
                <th>Преподаватель</th>
                <th>Модуль 1</th>
                <th>Модуль 2</th>
                <th>Итоговый контроль</th>
                <th class="table-primary text-dark">Общий балл</th>
                <th>Оценка</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $registration)
                @php
                    $module1 = $registration->grades->where('type','module1')->sum('grade');
                    $module2 = $registration->grades->where('type','module2')->sum('grade');
                    $final   = $registration->grades->where('type','final')->sum('grade');
                    $total   = $module1 + $module2 + $final;

                    if ($total <= 60) $result = 'н/у';
                    elseif ($total <= 73) $result = 'удов';
                    elseif ($total <= 86) $result = 'хор';
                    else $result = 'отл';
                @endphp
                <tr class="text-center">
                    {{-- Инфо о предмете --}}
                    <td class="text-start">
                        <strong>{{ $registration->subject->name ?? '—' }}</strong><br>
                        <small class="text-muted">{{ $registration->stream->name ?? '—' }}</small>
                    </td>

                    {{-- Преподаватель --}}
                    <td>
                        {{ $registration->teacher->first_name ?? '' }} 
                        {{ $registration->teacher->last_name ?? '' }}
                    </td>
                    
                    {{-- Модуль 1 --}}
                    <td>{{ $module1 }}</td>
                    
                    {{-- Модуль 2 --}}
                    <td>{{ $module2 }}</td>
                    
                    {{-- Итоговый контроль --}}
                    <td>{{ $final }}</td>
                    
                    {{-- Общий балл --}}
                    <td class="fw-bold fs-5 table-primary">{{ $total }}</td>

                    {{-- Итоговая оценка --}}
                    <td>
                        @if($result === 'н/у')
                            <span class="badge bg-danger">{{ $result }}</span>
                        @elseif($result === 'удов')
                            <span class="badge bg-warning text-dark">{{ $result }}</span>
                        @elseif($result === 'хор')
                            <span class="badge bg-primary">{{ $result }}</span>
                        @else
                            <span class="badge bg-success">{{ $result }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">У вас пока нет регистраций на предметы.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
