<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DataTables\CustomersDataTable;
use Illuminate\Http\Request;

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

    public function updateBlocked(Request $request, $id)
    {
        $data = $request->validate(['blocked' => 'required|boolean']);
        $customer = Customer::find($id);
        if ((bool)$data['blocked'] == (bool)$customer->blocked)
            abort(400, 'This customer is already ' . ($data['blocked'] ? '' : 'un') . 'blocked');
        $customer->blocked = $data['blocked'];
        $customer->save();
    }

    public function updateVerified(Request $request, $id)
    {
        $data = $request->validate(['verified' => 'required|boolean']);
        $customer = Customer::find($id);
        if ((bool)$data['verified'] == (bool)$customer->verified)
            abort(400, 'This customer is already ' . ($data['verified'] ? '' : 'un') . 'verified');
        $customer->verified = $data['verified'];
        $customer->save();
    }

    public function show($id)
    {
        $customer = Customer::withCount('transactions')->find($id);
        if(!$customer) abort(404);
        return view('customers.show', [
            'title' => 'Customer <' . $customer->email . '> details',
            'customer' => $customer
        ]);
    }
}