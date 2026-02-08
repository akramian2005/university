@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-3">{{ ucfirst($table) }}</h2>

    <a href="{{ route('admin.create', $table) }}" class="btn btn-success mb-3">
        + Add record
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                @foreach($columns as $col)
                    <th>{{ ucfirst(str_replace('_', ' ', $col)) }}</th>
                @endforeach
                <th width="160">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($records as $row)
                <tr>
                    @foreach($columns as $col)
                        <td>
                            {{ $row->$col ?? '—' }}
                        </td>
                    @endforeach

                    <td>
                        <a href="{{ route('admin.edit', [$table, $row->id]) }}"
                           class="btn btn-sm btn-primary">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.destroy', [$table, $row->id]) }}"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this record?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}" class="text-center">
                        No records found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $records->links() }}
    </div>

</div>

@endsection



