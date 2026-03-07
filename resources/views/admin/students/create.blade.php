@extends('layouts.app')

@section('title', 'Добавить студента')

@section('content')
<div class="container">
    <h2 class="mb-4">Добавить студента</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ошибки при заполнении формы:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
            @error('first_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
            @error('last_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Дата рождения</label>
            <input type="date" name="date_born" class="form-control" value="{{ old('date_born') }}" required>
            @error('date_born')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Фото</label>
            <input type="file" name="avatar" class="form-control">
            @error('avatar')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- селекты для gender, region, nationality, group, form_of_study остаются как у тебя --}}

        <div class="mb-3">
            <label class="form-label">Стоимость контракта</label>
            <input type="number" name="contract_price" class="form-control" value="{{ old('contract_price') }}">
            @error('contract_price')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Оплачено</label>
            <input type="number" name="contract_paid" class="form-control" value="{{ old('contract_paid') }}">
            @error('contract_paid')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success btn-sm">Сохранить</button>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary btn-sm">Назад</a>
        </div>

    </form>
</div>
@endsection
