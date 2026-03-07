<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Speciality;

class GroupsController extends Controller
{
    // Список всех групп
    public function index(Request $request)
    {
        $query = Group::withCount('students')->with('speciality');

        // Фильтры
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('name')) {
            $query->where('name','like',"%{$request->name}%");
        }

        if ($request->filled('speciality_id')) {
            $query->where('speciality_id',$request->speciality_id);
        }

        if ($request->filled('students_count')) {
            $query->has('students','=',$request->students_count);
        }

        // Сортировка
        $sortColumn = $request->get('sort_column','id');
        $sortDirection = $request->get('sort_direction','asc');
        $query->orderBy($sortColumn,$sortDirection);

        $groups = $query->paginate(10)->withQueryString();

        return view('admin.groups.index', [
            'groups' => $groups,
            'specialities' => Speciality::all(),
        ]);
    }

    // Просмотр конкретной группы и её студентов
    public function show(Group $group)
    {
        $group->load('students','speciality');
        return view('admin.groups.show', compact('group'));
    }

    // Форма редактирования
    public function edit(Group $group)
    {
        return view('admin.groups.edit', [
            'group' => $group,
            'specialities' => Speciality::all(),
        ]);
    }

    // Обновление группы
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'speciality_id' => 'required|exists:specialities,id',
        ]);

        $group->update($request->all());

        return redirect()->route('admin.groups.index')->with('success', 'Группа обновлена!');
    }

    // Удаление группы
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('admin.groups.index')->with('success', 'Группа удалена!');
    }
}
