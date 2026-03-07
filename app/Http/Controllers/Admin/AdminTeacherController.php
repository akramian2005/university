<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminTeacherController extends Controller
{
    // Список учителей
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Фильтры
        if ($request->filled('id')) {
            $query->where('id',$request->id);
        }
        if ($request->filled('name')) {
            $query->where(function($q) use ($request){
                $q->where('first_name','like',"%{$request->name}%")
                  ->orWhere('last_name','like',"%{$request->name}%");
            });
        }
        if ($request->filled('position')) {
            $query->where('position','like',"%{$request->position}%");
        }

        // Сортировка
        $sortColumn = $request->get('sort_column','id');
        $sortDirection = $request->get('sort_direction','asc');
        $query->orderBy($sortColumn,$sortDirection);

        $teachers = $query->paginate(10)->withQueryString();

        return view('admin.teachers.index',compact('teachers'));
    }

    // Форма добавления
    public function create()
    {
        return view('admin.teachers.create');
    }

    // Сохранение нового учителя
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'rate'       => 'nullable|numeric',
            'position'   => 'nullable|string|max:255',
            'avatar'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password'   => 'required|min:6',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('teachers','public');
        }

        $data['password'] = Hash::make($request->password);

        Teacher::create($data);

        return redirect()->route('admin.teachers.index')->with('success','Учитель добавлен');
    }

    // Просмотр/редактирование
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show',compact('teacher'));
    }

    // Обновление
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'rate'       => 'nullable|numeric',
            'position'   => 'nullable|string|max:255',
            'avatar'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password'   => 'nullable|min:6',
        ]);

        if ($request->hasFile('avatar')) {
            if ($teacher->avatar && Storage::disk('public')->exists($teacher->avatar)) {
                Storage::disk('public')->delete($teacher->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('teachers','public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success','Учитель обновлён');
    }

    // Удаление
    public function destroy(Teacher $teacher)
    {
        if ($teacher->avatar && Storage::disk('public')->exists($teacher->avatar)) {
            Storage::disk('public')->delete($teacher->avatar);
        }
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success','Учитель удалён');
    }
}
