<?php

namespace App\Http\Controllers;

use App\DataTables\CardsDataTable;

//Enables us to output flash messaging
use App\DataTables\Scopes\DateRangeFilterDataTableScope;
use Session;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CardsDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(CardsDataTable $dataTable)
    {
        return $dataTable
            ->addScope(new DateRangeFilterDataTableScope)
            ->render('cards.index', ['title' => 'Cards List']);
    }
}