<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param DataTables $datatables
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request, Datatables $datatables)
    {
        if ($request->ajax()) {
            $query = Customer::with('profile')->select('users.*');

            return $datatables->eloquent($query)->addColumn('details_url', function ($user) {
                return url('transactions/' . $user->id);
            })->make(true);
        }
        return view('users.users', ['title' => 'Users List']);
    }

}
