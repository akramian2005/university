@extends('layouts.app')

@section('content')
<h2>Create record in {{ $table }}</h2>

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

    <button class="btn btn-success">Save</button>
</form>
@endsection
