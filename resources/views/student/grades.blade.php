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
                <th>История оценок (баллы)</th>
                {{-- <th>Кол-во</th> --}}
                <th class="table-primary text-dark">Общий балл</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $registration)
                <tr>
                    {{-- Инфо о предмете --}}
                    <td>
                        <strong>{{ $registration->subject->name ?? '—' }}</strong><br>
                        <small class="text-muted">{{ $registration->stream->name ?? '—' }}</small>
                    </td>

                    {{-- Преподаватель --}}
                    <td>
                        {{ $registration->teacher->first_name ?? '' }} 
                        {{ $registration->teacher->last_name ?? '' }}
                    </td>
                    
                    {{-- Список баллов через запятую --}}
                    <td class="text-center">
                        @forelse($registration->grades as $grade)
                            <span class="badge border text-dark shadow-sm" title="Дата: {{ $grade->grade_date->format('d.m.Y') }} | {{ $grade->comment }}">
                                {{ $grade->grade }}
                            </span>
                        @empty
                            <span class="text-muted small">Оценок нет</span>
                        @endforelse
                    </td>
                    
                    {{-- Количество оценок --}}
                    {{-- <td class="text-center">
                        {{ $registration->grades->count() }}
                    </td> --}}

                    {{-- 🔥 ОБЩИЙ НАКОПЛЕННЫЙ БАЛЛ --}}
                    <td class="text-center fw-bold fs-5 table-primary">
                        {{ $registration->grades->sum('grade') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">У вас пока нет регистраций на предметы.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection