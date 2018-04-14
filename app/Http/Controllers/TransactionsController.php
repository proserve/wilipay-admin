<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionsController extends Controller
{
    public function getByUser($user_id){
        $transactions = Customer::find($user_id)->transactions();
        return Datatables::of($transactions)->make(true);
    }
}
