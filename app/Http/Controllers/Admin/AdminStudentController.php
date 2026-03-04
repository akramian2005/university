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

        $students = $query->paginate(10)->withQueryString(); // withQueryString сохраняет параметры поиска при переходе по страницам

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
            'first_name' => 'required',
            'last_name' => 'required',
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

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $student->update($data);

        return redirect()->back()->with('success', 'Студент обновлен');
    }
}