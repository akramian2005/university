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
        </div>

        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Дата рождения</label>
            <input type="date" name="date_born" class="form-control" value="{{ old('date_born') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Фото</label>
            <input type="file" name="avatar" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Пол</label>
            <select name="gender_id" class="form-select" required>
                @foreach($genders as $gender)
                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Регион</label>
            <select name="region_id" class="form-select" required>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Национальность</label>
            <select name="nationality_id" class="form-select" required>
                @foreach($nationalities as $nationality)
                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Группа</label>
            <select name="group_id" class="form-select" required>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Форма обучения</label>
            <select name="form_of_study_id" class="form-select" required>
                @foreach($forms as $form)
                    <option value="{{ $form->id }}">{{ $form->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Стоимость контракта</label>
            <input type="number" name="contract_price" class="form-control" value="{{ old('contract_price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Оплачено</label>
            <input type="number" name="contract_paid" class="form-control" value="{{ old('contract_paid') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Назад</a>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
@endsection
