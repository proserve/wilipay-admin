<?php

namespace App\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class LogsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ajax()
    {
        return DataTables::of($this->query())
            ->filterColumn('email', function ($query, $keyword) {
                $query->where('email', 'like', "%{$keyword}%");
            })->addColumn('intro', '{{$name}}')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $activities =
            DB::table('activity_log')->join('users', 'activity_log.causer_id', '=', 'users.id')
                ->select(['activity_log.*', 'users.email', 'users.name', 'users.avatar_url']);
        return $this->applyScopes($activities);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'reset', 'reload'],
            ]);
    }

    /**
     * @return array
     */
    protected
    function getColumns()
    {
        return [
            'description',
            'email',
            'properties',
            'created_at',
        ];
    }
}