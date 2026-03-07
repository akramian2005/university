@extends('layouts.app')

@section('title','Редактировать учителя')

@section('content')
<div class="container">
    <h2 class="mb-4">Редактировать учителя</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.teachers.update',$teacher->id) }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Имя</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name',$teacher->first_name) }}" required>
            @error('first_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Фамилия</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name',$teacher->last_name) }}" required>
            @error('last_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Адрес</label>
            <input type="text" name="address" class="form-control" value="{{ old('address',$teacher->address) }}">
            @error('address')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Должность</label>
            <input type="text" name="position" class="form-control" value="{{ old('position',$teacher->position) }}">
            @error('position')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ставка</label>
            <input type="number" step="0.1" name="rate" class="form-control" value="{{ old('rate',$teacher->rate) }}">
            @error('rate')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Пароль (оставьте пустым, если не менять)</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- <div class="mb-3">
            <label>Фото</label><br>
            @if($teacher->avatar)
                <img src="{{ asset('storage/'.$teacher->avatar) }}" alt="Аватар" class="img-thumbnail mb-2" width="120">
            @endif
            <input type="file" name="avatar" class="form-control">
            @error('avatar')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary btn-sm">Обновить</button>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary btn-sm">Назад</a>
        </div>
    </form>
</div>
@endsection
