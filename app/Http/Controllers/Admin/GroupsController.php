<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;


class GroupsController extends Controller
{
    // Список всех групп
    public function index()
    {
        $groups = Group::withCount('students')->paginate(10); // количество студентов для информации
        return view('admin.groups.index', compact('groups'));
    }

    // Просмотр конкретной группы и её студентов
    public function show(Group $group)
    {
        $group->load('students'); // загружаем студентов
        return view('admin.groups.show', compact('group'));
    }

    // Форма редактирования
    public function edit(Group $group)
    {
        return view('admin.groups.edit', compact('group'));
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