<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;

class AdminTableService
{
    protected array $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

    public function getTableData(string $table)
    {
        $records = DB::table($table)->paginate(10);
        $relations = AdminRelations::get();

        if (isset($relations[$table])) {
            foreach ($records as $record) {
                foreach ($relations[$table] as $column => $relation) {
                    if (!isset($record->$column)) continue;

                    $record->$column = DB::table($relation['table'])
                        ->where('id', $record->$column)
                        ->value($relation['field']) ?? '—';
                }
            }
        }

        foreach ($records as $record) {
            foreach ($this->hidden as $field) {
                unset($record->$field);
            }
        }

        $columns = $records->isEmpty()
            ? []
            : array_diff(array_keys((array)$records->first()), $this->hidden);

        return compact('records', 'columns');
    }
}
