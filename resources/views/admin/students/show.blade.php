@extends('layouts.app')

@section('title', 'Редактирование студента')

@section('content')
<div class="container">
    <h2 class="mb-4">Редактирование студента</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔥 Добавлен enctype="multipart/form-data" для работы с файлами --}}
    <form method="POST" action="{{ route('admin.students.update', $student->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Блок предварительного просмотра аватара --}}
            <div class="col-12 mb-4 text-center">
                <div class="current-avatar mb-2">
                    @if($student->avatar)
                        <img src="{{ asset('storage/' . $student->avatar) }}" 
                             alt="Текущий аватар" 
                             class="rounded-circle img-thumbnail" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->first_name . ' ' . $student->last_name) }}&size=150" 
                             class="rounded-circle img-thumbnail">
                    @endif
                </div>
                <div class="col-md-4 mx-auto">
                    <label class="form-label">Изменить фото профиля</label>
                    <input type="file" name="avatar" class="form-control" accept="image/*">
                    <small class="text-muted">Рекомендуется квадратное изображение (JPG, PNG)</small>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label>Имя</label>
                <input type="text" name="first_name" class="form-control"
                       value="{{ old('first_name', $student->first_name) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Фамилия</label>
                <input type="text" name="last_name" class="form-control"
                       value="{{ old('last_name', $student->last_name) }}">
            </div>

            {{-- ... остальные поля (дата рождения, пол, регион и т.д. остаются без изменений) ... --}}

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

        <div class="mt-4">
            <button type="submit" class="btn btn-success px-5">Сохранить</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Назад</a>
        </div>
    </form>
</div>
@endsection