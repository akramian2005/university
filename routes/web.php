<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Admin\GroupsController;

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
    Route::get('/groups', [GroupsController::class, 'index'])->name('admin.groups.index');           // список групп
    Route::get('/groups/create', [GroupsController::class, 'create'])->name('admin.groups.create');  // форма создания группы
    Route::post('/groups', [GroupsController::class, 'store'])->name('admin.groups.store');          // сохранение новой группы
    Route::get('/groups/{group}/edit', [GroupsController::class, 'edit'])->name('admin.groups.edit'); // форма редактирования
    Route::put('/groups/{group}', [GroupsController::class, 'update'])->name('admin.groups.update'); // обновление группы
    Route::delete('/groups/{group}', [GroupsController::class, 'destroy'])->name('admin.groups.destroy'); // удаление группы
    Route::get('/groups/{group}', [GroupsController::class, 'show'])->name('admin.groups.show');      // просмотр состава группы
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