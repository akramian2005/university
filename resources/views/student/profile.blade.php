@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Личный кабинет</h2>

    <p><strong>Имя:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
    <p><strong>ID:</strong> {{ $student->id }}</p>
    <p><strong>Группа:</strong> {{ $student->group->name ?? '—' }}</p>
    <p><strong>Форма обучения:</strong> {{ $student->formOfStudy->name ?? '—' }}</p>
    <p><strong>Режим обучения:</strong> {{ $student->studyMode->name ?? '—' }}</p>
    <p><strong>Стоимость контракта:</strong> {{ $student->contract_price }} сом</p>
    <p><strong>Оплачено:</strong> {{ $student->contract_paid }} сом</p>

</div>
@endsection