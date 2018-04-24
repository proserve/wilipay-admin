<?php

namespace App\Http\Controllers;

use App\DataTables\LogsDataTable;
use App\DataTables\Scopes\LogsDataTableScope;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param LogsDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(LogsDataTable $dataTable)
    {
        return $dataTable->render('logs.index', ['title' => 'User\'s Activities Log']);
    }
    public function me(LogsDataTable $dataTable)
    {
        return $dataTable->addScope(new LogsDataTableScope)->render('logs.index', ['title' => 'My Activities Log']);
    }
}