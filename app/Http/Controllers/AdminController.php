<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\Admin\AdminTableService;

class AdminController extends Controller
{
    public function __construct(
        private AdminTableService $service
    ) {}

    public function index()
    {
        $tables = config('admin.tables');

        return view('admin.index', compact('tables'));
    }

    public function showTable($table)
    {
        $data = $this->service->getTableData($table);

        return view('admin.table', [
            'table' => $table,
            ...$data
        ]);
    }
}

