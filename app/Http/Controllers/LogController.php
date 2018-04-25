<?php

namespace App\Http\Controllers;

use App\DataTables\LogsDataTable;
use App\DataTables\Scopes\DateRangeFilterDataTableScope;
use App\DataTables\Scopes\LogsDataTableScope;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param LogsDataTable $dataTable
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(LogsDataTable $dataTable, Request $request)
    {
        return $dataTable
            ->addScope(new DateRangeFilterDataTableScope('activity_log.created_at'))
            ->render('logs.index', ['title' => 'User\'s Activities Log']);
    }

    public function me(LogsDataTable $dataTable, Request $request)
    {
        return $dataTable
            ->addScope(new LogsDataTableScope())
            ->addScope(new DateRangeFilterDataTableScope('activity_log.created_at'))
            ->render('logs.index', ['title' => 'My Activities Log']);
    }
}