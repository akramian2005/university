@extends('layouts.app')

@section('content')
<h2>{{ ucfirst($table) }}</h2>

<a href="{{ route('admin.create', $table) }}" class="btn btn-success mb-3">
    + Add record
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            @foreach($columns as $col)
                <th>{{ $col }}</th>
            @endforeach
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($records as $row)
            <tr>
                @foreach($columns as $col)
                    <td>{{ $row->$col }}</td>
                @endforeach
                <td>
                    <a href="{{ route('admin.edit', [$table, $row->id]) }}"
                       class="btn btn-sm btn-primary">Edit</a>

                    <form method="POST"
                          action="{{ route('admin.destroy', [$table, $row->id]) }}"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
