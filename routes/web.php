<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware; // <- один импорт
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrationController;


Route::get('/', function () {
    return view('index');
})->name('home');


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/table/{table}', [AdminController::class, 'showTable'])
        ->name('admin.table');

    Route::get('/table/{table}/create', [AdminController::class, 'create'])
        ->name('admin.create');

    Route::post('/table/{table}', [AdminController::class, 'store'])
        ->name('admin.store');

    Route::get('/table/{table}/{id}/edit', [AdminController::class, 'edit'])
        ->name('admin.edit');

    Route::put('/table/{table}/{id}', [AdminController::class, 'update'])
        ->name('admin.update');

    Route::delete('/table/{table}/{id}', [AdminController::class, 'destroy'])
        ->name('admin.destroy');
});


// Студент
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

// Учитель
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');

    Route::get('/subjects', [TeacherController::class, 'mySubjects'])
    ->name('teacher.subjects');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('registrations/create', [RegistrationController::class, 'create'])
        ->name('registrations.create');

    Route::post('registrations', [RegistrationController::class, 'store'])
        ->name('registrations.store');

            // Просмотр своих регистраций
    Route::get('registrations', [RegistrationController::class, 'student'])->name('student.registrations');


    // AJAX для потоков
    Route::get('streams', [RegistrationController::class, 'getStreams']);
    
    // AJAX для учителей
    Route::get('teachers', [RegistrationController::class, 'getTeachers']);
});


// Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
//     Route::get('/', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
// });

Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('/registrations', [RegistrationController::class, 'student'])
        ->name('student.registrations');
});
