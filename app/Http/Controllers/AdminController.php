<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    protected array $relations = [
        'students' => [
            'gender_id' => ['table' => 'genders', 'field' => 'name'],
            'region_id' => ['table' => 'regions', 'field' => 'name'],
            'nationality_id' => ['table' => 'nationalities', 'field' => 'name'],
            'group_id' => ['table' => 'groups', 'field' => 'name'],
            'form_of_study_id' => ['table' => 'form_of_studies', 'field' => 'name'],
        ],

        'groups' => [
            'speciality_id' => ['table' => 'specialities', 'field' => 'name'],
        ],

        'specialities' => [
            'faculty_id' => ['table' => 'faculties', 'field' => 'name'],
        ],
        'departments' => [
            'faculty_id' => ['table' => 'faculties', 'field' => 'name'],
        ],

        'teachers' => [
            'gender_id' => ['table' => 'genders', 'field' => 'name'],
            'department_id' => ['table' => 'departments', 'field' => 'name'],
        ],
    ];

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
        $records = DB::table($table)->paginate(10);

        $hiddenColumns = ['password', 'remember_token', 'created_at', 'updated_at']; // колонки, которые не показываем

        // если есть связи, подменяем *_id на читаемые значения
        if (isset($this->relations[$table])) {
            foreach ($records as $record) {
                foreach ($this->relations[$table] as $column => $relation) {
                    if (!isset($record->$column)) continue;

                    $value = DB::table($relation['table'])
                        ->where('id', $record->$column)
                        ->value($relation['field']);

                    $record->$column = $value ?? '—';
                }
            }
        }

        // формируем список колонок для заголовков
        if ($records->isEmpty()) {
            $columns = [];
        } else {
            $columns = array_diff(array_keys((array) $records->first()), $hiddenColumns);
        }

        // удаляем скрытые поля из каждой записи
        foreach ($records as $record) {
            foreach ($hiddenColumns as $hidden) {
                unset($record->$hidden);
            }
        }

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
