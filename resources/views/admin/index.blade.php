@extends('layouts.app')

@section('title', 'Административная панель')

@section('content')
<h2 class="mb-4">Административная панель</h2>

<div class="row">
    @foreach($tables as $table)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title text-primary">
                            {{ ucfirst($table) }}
                        </h5>
                        <p class="card-text text-muted">
                            Управление данными таблицы "{{ ucfirst($table) }}"
                        </p>
                    </div>

                    <a href="{{ route('admin.table', $table) }}" 
                       class="btn btn-outline-primary mt-3">
                        Открыть
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection