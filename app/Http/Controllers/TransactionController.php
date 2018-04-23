<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Transaction;
use App\User;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function getByUser($user_id, DataTables $datatables)
    {
        try {
            $transactions = Customer::find($user_id)->transactions();
            return $datatables->eloquent($transactions)->addColumn('currency', function ($transaction) {
                return $transaction->account_id ? $transaction->account->currency_code : '';
            })->make(true);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
