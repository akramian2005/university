<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Gender;
use App\Models\Region;
use App\Models\Nationality;
use App\Models\Group;
use App\Models\FormOfStudy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Добавлено для работы с файлами

class AdminStudentController extends Controller
{
    // Список студентов
    public function index(Request $request)
    {
        $query = Student::query()->with('group');

        // Поиск по ID
        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        // Поиск по Имени или Фамилии
        if ($request->filled('search_name')) {
            $name = $request->search_name;
            $query->where(function($q) use ($name) {
                $q->where('first_name', 'LIKE', "%{$name}%")
                ->orWhere('last_name', 'LIKE', "%{$name}%");
            });
        }

        $students = $query->paginate(10)->withQueryString();

        return view('admin.students.index', compact('students'));
    }

    // Страница студента
    public function show(Student $student)
    {
        return view('admin.students.show', [
            'student' => $student,
            'genders' => Gender::all(),
            'regions' => Region::all(),
            'nationalities' => Nationality::all(),
            'groups' => Group::all(),
            'forms' => FormOfStudy::all(),
        ]);
    }

    // Обновление
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Валидация фото
            'date_born' => 'required|date',
            'gender_id' => 'required|exists:genders,id',
            'region_id' => 'required|exists:regions,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'group_id' => 'required|exists:groups,id',
            'form_of_study_id' => 'required|exists:form_of_studies,id',
            'contract_price' => 'nullable|numeric',
            'contract_paid' => 'nullable|numeric',
            'password' => 'nullable|min:6',
        ]);

        // 🔥 Обработка аватара
        if ($request->hasFile('avatar')) {
            // Удаляем старый файл, если он существует
            if ($student->avatar && Storage::disk('public')->exists($student->avatar)) {
                Storage::disk('public')->delete($student->avatar);
            }

            // Сохраняем новый файл в папку avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        // Обработка пароля
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $student->update($data);

        return redirect()->back()->with('success', 'Данные студента и фото обновлены');
    }

        // Форма добавления студента
    public function create()
    {
        return view('admin.students.create', [
            'genders' => Gender::all(),
            'regions' => Region::all(),
            'nationalities' => Nationality::all(),
            'groups' => Group::all(),
            'forms' => FormOfStudy::all(),
        ]);
    }

    // Сохранение нового студента
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date_born' => 'required|date',
            'gender_id' => 'required|exists:genders,id',
            'region_id' => 'required|exists:regions,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'group_id' => 'required|exists:groups,id',
            'form_of_study_id' => 'required|exists:form_of_studies,id',
            'contract_price' => 'nullable|numeric',
            'contract_paid' => 'nullable|numeric',
            'password' => 'required|min:6',
        ]);

        // Обработка аватара
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        // Хэшируем пароль
        $data['password'] = Hash::make($request->password);

        Student::create($data);

        return redirect()->route('admin.students.index')->with('success', 'Студент успешно добавлен');
    }

}