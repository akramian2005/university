<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    // Список таблиц (белый список — безопасно)
    public function index()
    {
        $tables = [
            'faculties',
            'departments',
            'specialities',
            'groups',
            'students',
            'teachers',
            'subjects',
            'genders',
            'regions',
            'nationalities',
            'form_of_studies',
            'buildings',
            'classrooms',
        ];

        return view('admin.index', compact('tables'));
    }

    // Просмотр таблицы
    public function showTable($table)
    {
        $records = DB::table($table)->get();
        $columns = Schema::getColumnListing($table);

        return view('admin.table', compact('table', 'records', 'columns'));
    }

    // Форма создания записи
    public function create($table)
    {
        $columns = Schema::getColumnListing($table);

        return view('admin.create', compact('table', 'columns'));
    }

    // Сохранение записи
    public function store(Request $request, $table)
    {
        DB::table($table)->insert(
            $request->except('_token')
        );

        return redirect()->route('admin.table', $table);
    }

    // Форма редактирования
    public function edit($table, $id)
    {
        $record = DB::table($table)->where('id', $id)->first();
        $columns = Schema::getColumnListing($table);

        return view('admin.edit', compact('table', 'record', 'columns'));
    }

    // Обновление записи
    public function update(Request $request, $table, $id)
    {
        DB::table($table)
            ->where('id', $id)
            ->update($request->except('_token', '_method'));

        return redirect()->route('admin.table', $table);
    }

    // Удаление записи
    public function destroy($table, $id)
    {
        DB::table($table)->where('id', $id)->delete();

        return back();
    }
}
