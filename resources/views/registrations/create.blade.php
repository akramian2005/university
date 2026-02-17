@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register for a Subject</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('registrations.store') }}" method="POST">
        @csrf

        <label>Semester:</label>
        <select name="semester_id" class="form-control" required>
            <option value="">Select Semester</option>
            @foreach($semesters as $semester)
                <option value="{{ $semester->id }}">{{ $semester->name }}</option>
            @endforeach
        </select>

        <label>Subject:</label>
        <select name="subject_id" id="subjectSelect" class="form-control" required>
            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>

        <label>Stream:</label>
        <select name="stream_id" id="streamSelect" class="form-control" required>
            <option value="">Select Stream</option>
        </select>

        <label>Teacher:</label>
        <select name="teacher_id" id="teacherSelect" class="form-control" required>
            <option value="">Select Teacher</option>
        </select>

        <button type="submit" class="btn btn-primary mt-3">Register</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#subjectSelect').on('change', function() {
    let subjectId = $(this).val();

    if(!subjectId) return;

    // Загрузка потоков
    $.get("{{ url('student/streams') }}", { subject_id: subjectId }, function(data) {
        let options = '<option value="">Select Stream</option>';
        data.forEach(s => options += `<option value="${s.id}">${s.name}</option>`);
        $('#streamSelect').html(options);
    });

    // Загрузка учителей
    $.get("{{ url('student/teachers') }}", { subject_id: subjectId }, function(data) {
        let options = '<option value="">Select Teacher</option>';
        data.forEach(t => options += `<option value="${t.id}">${t.first_name} ${t.last_name}</option>`);
        $('#teacherSelect').html(options);
    });
});
</script>
@endsection
