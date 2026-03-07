@extends('layouts.app')

@section('title', 'Студенты')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Список студентов</h2>
        <a href="{{ route('admin.students.create') }}" class="btn btn-success">
            + Добавить студента
        </a>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.students.index') }}" method="GET" class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="search_id" class="form-control" placeholder="ID" value="{{ request('search_id') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="search_name" class="form-control" placeholder="Имя или Фамилия" value="{{ request('search_name') }}">
                </div>
                <div class="col-md-2">
                    <select name="group_id" class="form-select">
                        <option value="">Все группы</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" @selected(request('group_id') == $group->id)>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="region_id" class="form-select">
                        <option value="">Все регионы</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" @selected(request('region_id') == $region->id)>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="gender_id" class="form-select">
                        <option value="">Все</option>
                        @foreach($genders as $gender)
                            <option value="{{ $gender->id }}" @selected(request('gender_id') == $gender->id)>
                                {{ $gender->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="nationality_id" class="form-select">
                        <option value="">Все национальности</option>
                        @foreach($nationalities as $nationality)
                            <option value="{{ $nationality->id }}" @selected(request('nationality_id') == $nationality->id)>
                                {{ $nationality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="form_of_study_id" class="form-select">
                        <option value="">Все формы обучения</option>
                        @foreach($forms as $form)
                            <option value="{{ $form->id }}" @selected(request('form_of_study_id') == $form->id)>
                                {{ $form->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort_column" class="form-select">
                        <option value="id" @selected(request('sort_column')=='id')>ID</option>
                        <option value="last_name" @selected(request('sort_column')=='last_name')>Фамилия</option>
                        <option value="first_name" @selected(request('sort_column')=='first_name')>Имя</option>
                        <option value="group_id" @selected(request('sort_column')=='group_id')>Группа</option>
                        <option value="region_id" @selected(request('sort_column')=='region_id')>Регион</option>
                        <option value="gender_id" @selected(request('sort_column')=='gender_id')>Пол</option>
                        <option value="nationality_id" @selected(request('sort_column')=='nationality_id')>Национальность</option>
                        <option value="form_of_study_id" @selected(request('sort_column')=='form_of_study_id')>Форма обучения</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort_direction" class="form-select">
                        <option value="asc" @selected(request('sort_direction')=='asc')>↑ Возрастание</option>
                        <option value="desc" @selected(request('sort_direction')=='desc')>↓ Убывание</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Группа</th>
                <th>Регион</th>
                <th>Пол</th>
                <th>Национальность</th>
                <th>Форма обучения</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->group->name ?? '—' }}</td>
                    <td>{{ $student->region->name ?? '—' }}</td>
                    <td>{{ $student->gender->name ?? '—' }}</td>
                    <td>{{ $student->nationality->name ?? '—' }}</td>
                    <td>{{ $student->formOfStudy->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.students.show', $student->id) }}"
                           class="btn btn-sm btn-primary">
                            Открыть
                        </a>

                        <form action="{{ route('admin.students.destroy', $student->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Вы уверены, что хотите удалить этого студента?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-muted">Студенты не найдены</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $students->links() }}
    </div>
</div>
@endsection
