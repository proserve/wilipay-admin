<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::where('created_at', '>=', Carbon::now()->subMonth())
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        return view('home', ['title' => 'Dashboard']);
    }
}
