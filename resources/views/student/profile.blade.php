@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Личный кабинет</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center border-end">
                    <div class="mb-3">
                        @if($student->avatar)
                            <img src="{{ asset('storage/' . $student->avatar) }}" 
                                 alt="Аватар" 
                                 class="rounded-circle img-thumbnail shadow-sm" 
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->first_name . ' ' . $student->last_name) }}&size=200&background=random" 
                                 alt="Default Avatar" 
                                 class="rounded-circle img-thumbnail shadow-sm">
                        @endif
                    </div>
                    <h4>{{ $student->first_name }} {{ $student->last_name }}</h4>
                    <span class="badge bg-info text-dark">ID: {{ $student->id }}</span>
                </div>

                <div class="col-md-8 ps-md-4">
                    <h5 class="border-bottom pb-2 mb-3">Основная информация</h5>
                    
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Группа:</div>
                        <div class="col-sm-8 fw-bold">{{ $student->group->name ?? '—' }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Форма обучения:</div>
                        <div class="col-sm-8">{{ $student->formOfStudy->name ?? '—' }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Режим обучения:</div>
                        <div class="col-sm-8">{{ $student->studyMode->name ?? '—' }}</div>
                    </div>

                    <h5 class="border-bottom pb-2 mb-3 mt-4">Финансовая информация</h5>

                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Стоимость контракта:</div>
                        <div class="col-sm-8 text-danger fw-bold">{{ number_format($student->contract_price, 0, '.', ' ') }} сом</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Оплачено:</div>
                        <div class="col-sm-8 text-success fw-bold">{{ number_format($student->contract_paid, 0, '.', ' ') }} сом</div>
                    </div>
                    
                    @php
                        $debt = $student->contract_price - $student->contract_paid;
                    @endphp

                    @if($debt > 0)
                        <div class="alert alert-warning mt-3">
                            <i class="bi bi-exclamation-triangle"></i> Остаток к оплате: <strong>{{ number_format($debt, 0, '.', ' ') }} сом</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection