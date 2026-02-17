@extends('layouts.app')

@section('content')
<h2>Edit {{ ucfirst($table) }}</h2>

<form method="POST" action="{{ route('admin.update', [$table, $record->id]) }}">
    @csrf
    @method('PUT')

    @foreach($columns as $column)
        @if($column === 'id')
            @continue
        @endif

        <div class="mb-3">
            <label class="form-label">{{ $column }}</label>
            <input type="text"
                   name="{{ $column }}"
                   value="{{ $record->$column }}"
                   class="form-control">
        </div>
    @endforeach

    <button class="btn btn-primary">Save</button>
</form>
@endsection