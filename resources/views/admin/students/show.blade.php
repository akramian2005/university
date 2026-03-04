@extends('layouts.app')

@section('title', 'Студент')

@section('content')
<div class="container">
    <h2 class="mb-4">Редактирование студента</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Имя</label>
                <input type="text" name="first_name" class="form-control"
                       value="{{ $student->first_name }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Фамилия</label>
                <input type="text" name="last_name" class="form-control"
                       value="{{ $student->last_name }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Дата рождения</label>
                <input type="date" name="date_born" class="form-control"
                       value="{{ $student->date_born }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Пол</label>
                <select name="gender_id" class="form-control">
                    @foreach($genders as $gender)
                        <option value="{{ $gender->id }}"
                            {{ $student->gender_id == $gender->id ? 'selected' : '' }}>
                            {{ $gender->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Регион</label>
                <select name="region_id" class="form-control">
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}"
                            {{ $student->region_id == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Национальность</label>
                <select name="nationality_id" class="form-control">
                    @foreach($nationalities as $nation)
                        <option value="{{ $nation->id }}"
                            {{ $student->nationality_id == $nation->id ? 'selected' : '' }}>
                            {{ $nation->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Группа</label>
                <select name="group_id" class="form-control">
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}"
                            {{ $student->group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Форма обучения</label>
                <select name="form_of_study_id" class="form-control">
                    @foreach($forms as $form)
                        <option value="{{ $form->id }}"
                            {{ $student->form_of_study_id == $form->id ? 'selected' : '' }}>
                            {{ $form->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Цена контракта</label>
                <input type="number" name="contract_price"
                       class="form-control"
                       value="{{ $student->contract_price }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Оплачено</label>
                <input type="number" name="contract_paid"
                       class="form-control"
                       value="{{ $student->contract_paid }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Новый пароль (необязательно)</label>
                <input type="password" name="password"
                       class="form-control">
            </div>

        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>
@endsection