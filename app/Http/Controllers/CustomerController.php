<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CustomersDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(CustomersDataTable $dataTable)
    {
        return $dataTable->render('customers.index', ['title' => 'Customers List']);
    }
}