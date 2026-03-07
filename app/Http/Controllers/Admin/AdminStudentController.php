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
use Illuminate\Support\Facades\Storage;

class AdminStudentController extends Controller
{
    // Список студентов
    public function index(Request $request)
    {
        $query = Student::query()->with(['group','region','gender','nationality','formOfStudy']);

        // Фильтры
        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        if ($request->filled('search_name')) {
            $name = $request->search_name;
            $query->where(function($q) use ($name) {
                $q->where('first_name', 'LIKE', "%{$name}%")
                  ->orWhere('last_name', 'LIKE', "%{$name}%");
            });
        }

        if ($request->filled('group_id')) {
            $query->where('group_id', $request->group_id);
        }

        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        if ($request->filled('gender_id')) {
            $query->where('gender_id', $request->gender_id);
        }

        if ($request->filled('nationality_id')) {
            $query->where('nationality_id', $request->nationality_id);
        }

        if ($request->filled('form_of_study_id')) {
            $query->where('form_of_study_id', $request->form_of_study_id);
        }

        // Сортировка
        $sortColumn = $request->get('sort_column', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortColumn, $sortDirection);

        $students = $query->paginate(10)->withQueryString();

        return view('admin.students.index', [
            'students' => $students,
            'groups' => Group::all(),
            'regions' => Region::all(),
            'genders' => Gender::all(),
            'nationalities' => Nationality::all(),
            'forms' => FormOfStudy::all(),
        ]);
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date_born' => 'required|date',
            'gender_id' => 'required|exists:genders,id',
            'region_id' => 'required|exists:regions,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'group_id' => 'required|exists:groups,id',
            'form_of_study_id' => 'required|exists:form_of_studies,id',
            'contract_price' => 'nullable|numeric',
            'contract_paid' => 'nullable|numeric',
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[\W]/',
            ],
        ]);

        if ($request->hasFile('avatar')) {
            if ($student->avatar && Storage::disk('public')->exists($student->avatar)) {
                Storage::disk('public')->delete($student->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $student->update($data);

        return redirect()->back()->with('success', 'Данные студента обновлены');
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
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',      // хотя бы одна заглавная буква
                'regex:/[a-z]/',      // хотя бы одна строчная буква
                'regex:/[0-9]/',      // хотя бы одна цифра
                'regex:/[\W]/',       // хотя бы один спецсимвол
            ],
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $data['password'] = Hash::make($request->password);

        Student::create($data);

        return redirect()->route('admin.students.index')->with('success', 'Студент успешно добавлен');
    }

    // Удаление студента
    public function destroy(Student $student)
    {
        if ($student->avatar && Storage::disk('public')->exists($student->avatar)) {
            Storage::disk('public')->delete($student->avatar);
        }

        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Студент удалён');
    }

}
