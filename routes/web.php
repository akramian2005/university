<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware; // <- один импорт
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;


Route::get('/', function () {
    return view('index');
});

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
});



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

