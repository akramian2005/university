<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;

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

    Route::get('/table/{table}', [AdminController::class, 'showTable'])->name('admin.table');
    Route::get('/table/{table}/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/table/{table}', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/table/{table}/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/table/{table}/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/table/{table}/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

/*
|--------------------------------------------------------------------------
| Студент
|--------------------------------------------------------------------------
*/
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/schedule', [ScheduleController::class, 'student'])->name('student.schedule');

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
});