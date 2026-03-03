@extends('layouts.app')

@section('content')
<h2>Создать запись в таблице {{ ucfirst($table) }}</h2>

<form method="POST" action="{{ route('admin.store', $table) }}">
    @csrf

    @foreach($columns as $col)
        @if($col !== 'id')
            <div class="mb-2">
                <label>{{ $col }}</label>
                <input name="{{ $col }}" class="form-control">
            </div>
        @endif
    @endforeach

    <button class="btn btn-success">Создать запись</button>
</form>
@endsection
