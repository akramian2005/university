<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;

class AuthController extends Controller
{
    // Показываем форму логина
    public function showLogin()
    {
        return view('auth.login');
    }

    // Логин
    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'password' => 'required|string',
        ]);

        $id = $request->id;
        $password = $request->password;

        // Проверка админа
        $admin = User::where('id', $id)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('web')->login($admin); // guard для админа
            return redirect()->intended('/admin');
        }

        // Проверка студента
        $student = Student::where('id', $id)->first();
        if ($student && Hash::check($password, $student->password)) {
            Auth::guard('student')->login($student); // guard для студента
            return redirect()->intended('/student');
        }

        // Проверка учителя
        $teacher = Teacher::where('id', $id)->first();
        if ($teacher && Hash::check($password, $teacher->password)) {
            Auth::guard('teacher')->login($teacher); // guard для учителя
            return redirect()->intended('/teacher');
        }

        // Если ничего не подошло
        return back()->withErrors([
            'id' => 'ID или пароль неверны'
        ]);
    }

    // Логаут
    public function logout(Request $request)
    {
        // Логаут из всех guards
        Auth::guard('web')->logout();
        Auth::guard('student')->logout();
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
