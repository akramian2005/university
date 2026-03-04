@extends('layouts.app')

@section('title', 'Редактировать группу')

@section('content')
<div class="container">
    <h2 class="mb-4">Редактирование группы</h2>

    <form action="{{ route('admin.groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Название группы</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $group->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Специальность</label>
            <select name="speciality_id" class="form-control" required>
                @foreach(\App\Models\Speciality::all() as $spec)
                    <option value="{{ $spec->id }}" {{ $group->speciality_id == $spec->id ? 'selected' : '' }}>
                        {{ $spec->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('admin.groups.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection