@extends('layouts.app')

@section('title','Добавить учителя')

@section('content')
<div class="container">
    <h2 class="mb-4">Добавить учителя</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm">
        @csrf

        <div class="mb-3">
            <label>Имя</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
            @error('first_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Фамилия</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
            @error('last_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Адрес</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
            @error('address')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Должность</label>
            <select name="position" class="form-select">
                <option value="">-- Выберите должность --</option>
                <option value="Старший преподаватель" {{ old('position')=='Старший преподаватель' ? 'selected' : '' }}>Старший преподаватель</option>
                <option value="Доцент" {{ old('position')=='Доцент' ? 'selected' : '' }}>Доцент</option>
                <option value="Профессор" {{ old('position')=='Профессор' ? 'selected' : '' }}>Профессор</option>
            </select>
            @error('position')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ставка</label>
            <input type="number" step="0.1" name="rate" class="form-control" value="{{ old('rate') }}">
            @error('rate')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Фото</label>
            <input type="file" name="avatar" class="form-control">
            @error('avatar')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
