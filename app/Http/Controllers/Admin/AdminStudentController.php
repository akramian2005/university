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
    public function index()
    {
        $students = Student::with('group')->paginate(10);
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