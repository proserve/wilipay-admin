<?php

namespace App\Http\Controllers;


use App\Customer;
use App\DataTables\Scopes\CustomerIdDataTableScope;
use App\DataTables\Scopes\DateRangeFilterDataTableScope;
use App\DataTables\TransactionsDataTable;
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

    public function index(TransactionsDataTable $dataTable)
    {
        return $dataTable
            ->addScope(new DateRangeFilterDataTableScope)
            ->render('transactions.index', ['title' => 'Transactions List']);
    }

    public function byCustomerId($customerId){
        $query = Transaction::with(['account' => function($query) use ($customerId){
            $query->where('user_id', $customerId);
        }]);
        $filterDataTableScope = new DateRangeFilterDataTableScope('transactions.created_at');
        $query = $filterDataTableScope->apply($query);
        return DataTables::of($query)->make(true);
    }
}
