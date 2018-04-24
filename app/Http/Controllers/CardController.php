<?php

namespace App\Http\Controllers;

use App\DataTables\CardsDataTable;

//Enables us to output flash messaging
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
        return $dataTable->render('cards.index', ['title' => 'Cards List']);
    }
}