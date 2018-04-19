<?php

namespace App\Http\Controllers;


use App\Transaction;
use Yajra\DataTables\DataTables;

class TransactionsController extends Controller
{
    public function getByUser($user_id, DataTables $datatables)
    {
        $transactions = Transaction::with(['account' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }]);
        return $datatables->eloquent($transactions)->addColumn('currency', function ($transaction) {
            return $transaction->account->currency_code;
        })->make(true);
    }
}
