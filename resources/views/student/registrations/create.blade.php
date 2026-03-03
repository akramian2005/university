@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Регистрация на дисциплину</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('registrations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Семестр:</label>
            <select name="semester_id" class="form-select" required>
                <option value="">Выберите семестр</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Дисциплина:</label>
            <select name="subject_id" id="subjectSelect" class="form-select" required>
                <option value="">Выберите дисциплину</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Поток:</label>
            <select name="stream_id" id="streamSelect" class="form-select" required>
                <option value="">Выберите поток</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Преподаватель:</label>
            <select name="teacher_id" id="teacherSelect" class="form-select" required>
                <option value="">Выберите преподавателя</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#subjectSelect').on('change', function() {
    let subjectId = $(this).val();

    if(!subjectId) return;

    // Загрузка потоков
    $.get("{{ url('student/streams') }}", { subject_id: subjectId }, function(data) {
        let options = '<option value="">Выберите поток</option>';
        data.forEach(s => options += `<option value="${s.id}">${s.name}</option>`);
        $('#streamSelect').html(options);
    });

    // Загрузка преподавателей
    $.get("{{ url('student/teachers') }}", { subject_id: subjectId }, function(data) {
        let options = '<option value="">Выберите преподавателя</option>';
        data.forEach(t => options += `<option value="${t.id}">${t.first_name} ${t.last_name}</option>`);
        $('#teacherSelect').html(options);
    });
});
</script>
@endsection