<?php

namespace App\Http\Controllers;

use App\Card;
use App\DataTables\CardsDataTable;

//Enables us to output flash messaging
use App\DataTables\Scopes\DateRangeFilterDataTableScope;
use Session;
use Yajra\DataTables\DataTables;

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
            ->addScope(new DateRangeFilterDataTableScope('cards.created_at'))
            ->render('cards.index', ['title' => 'Cards List']);
    }

    public function byCustomerId($customerId)
    {
        $query = Card::where('user_id', $customerId)->select();
        $filterDataTableScope = new DateRangeFilterDataTableScope('cards.created_at');
        $query = $filterDataTableScope->apply($query);
        return DataTables::of($query)->make(true);
    }
}