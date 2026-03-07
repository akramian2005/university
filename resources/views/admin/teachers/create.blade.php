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
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Фамилия</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Адрес</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-3">
            <label>Должность</label>
            <input type="text" name="position" class="form-control">
        </div>
        <div class="mb-3">
            <label>Ставка</label>
            <input type="number" step="0.1" name="rate" class="form-control">
        </div>
        <div class="mb-3">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Фото</label>
            <input type="file" name="avatar" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
