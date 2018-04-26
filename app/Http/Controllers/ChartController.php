<?php

namespace App\Http\Controllers;


use App\User;
use http\Env\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function usersPerDay(Request $request)
    {
        $request->validate([
            'startDate' => 'date',
            'endDate' => 'date'
        ]);
        return User::where('created_at', '>=', Carbon::now()->subMonth())
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "newUsers"')
            ));
    }
}
