<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\AdminStudentController;

/*
|--------------------------------------------------------------------------
| Главная страница
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('index');
})->name('home');

/*
|--------------------------------------------------------------------------
| Авторизация
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Админ
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Универсальное управление таблицами
    Route::get('/table/{table}', [AdminController::class, 'showTable'])->name('admin.table');
    Route::get('/table/{table}/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/table/{table}', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/table/{table}/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/table/{table}/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/table/{table}/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Администрирование групп
    Route::get('/groups', [GroupsController::class, 'index'])->name('admin.groups.index');
    Route::get('/groups/create', [GroupsController::class, 'create'])->name('admin.groups.create');
    Route::post('/groups', [GroupsController::class, 'store'])->name('admin.groups.store');
    Route::get('/groups/{group}/edit', [GroupsController::class, 'edit'])->name('admin.groups.edit');
    Route::put('/groups/{group}', [GroupsController::class, 'update'])->name('admin.groups.update');
    Route::delete('/groups/{group}', [GroupsController::class, 'destroy'])->name('admin.groups.destroy');
    Route::get('/groups/{group}', [GroupsController::class, 'show'])->name('admin.groups.show');

    // Администрирование студентов
    Route::get('/students', [AdminStudentController::class, 'index'])->name('admin.students.index');
    Route::get('/students/{student}', [AdminStudentController::class, 'show'])->name('admin.students.show');
    Route::put('/students/{student}', [AdminStudentController::class, 'update'])->name('admin.students.update');
});

/*
|--------------------------------------------------------------------------
| Студент
|--------------------------------------------------------------------------
*/
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/schedule', [ScheduleController::class, 'student'])->name('student.schedule');
    Route::get('/profile', [StudentController::class, 'profile'])->name('student.profile');

    // 🔥 Оценки студента (используем твой метод в StudentController)
    Route::get('/grades', [StudentController::class, 'grades'])->name('student.grades');

    // Регистрации
    Route::get('registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('registrations', [RegistrationController::class, 'student'])->name('student.registrations');

    // AJAX
    Route::get('streams', [RegistrationController::class, 'getStreams']);
    Route::get('teachers', [RegistrationController::class, 'getTeachers']);
});

/*
|--------------------------------------------------------------------------
| Учитель
|--------------------------------------------------------------------------
*/
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/subjects', [TeacherController::class, 'mySubjects'])->name('teacher.subjects');
    Route::get('/schedule', [ScheduleController::class, 'teacher'])->name('teacher.schedule');
    Route::get('/profile', [TeacherController::class, 'profile'])->name('teacher.profile');

    // 🔥 Потоки и Оценки учителя (используем методы из твоего TeacherController)
    Route::get('/streams', [TeacherController::class, 'streams'])->name('teacher.streams');
    Route::get('/streams/{stream}', [TeacherController::class, 'streamStudents'])->name('teacher.streams.students');
    
    // В контроллере у тебя метод называется storeGrade
    Route::post('/grades/store', [TeacherController::class, 'storeGrade'])->name('teacher.grades.store');
});