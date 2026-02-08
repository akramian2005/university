<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'password' => 'required|string',
        ]);

        $id = $request->id;
        $password = $request->password;

        // проверка админа
        $admin = User::where('id', $id)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::login($admin);
            return redirect()->intended('/admin');
        }

        // проверка студента
        $student = Student::where('id', $id)->first();
        if ($student && Hash::check($password, $student->password)) {
            Auth::login($student); // студент тоже в Auth
            return redirect()->intended('/student'); // можно отдельная панель для студентов
        }

        return back()->withErrors(['id' => 'ID или пароль неверны']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
