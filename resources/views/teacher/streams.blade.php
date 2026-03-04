@extends('layouts.app')

@section('title', 'Мои потоки')

@section('content')
<div class="container">
    <h2>Мои потоки</h2>
    <div class="list-group mt-4">
        @forelse($streams as $stream)
            {{-- Роут из нашего нового web.php --}}
            <a href="{{ route('teacher.streams.students', $stream->id) }}" 
               class="list-group-item list-group-item-action">
                {{ $stream->name }} ({{ $stream->subject->name ?? 'Без предмета' }})
            </a>
        @empty
            <p>У вас пока нет активных потоков.</p>
        @endforelse
    </div>
</div>
@endsection