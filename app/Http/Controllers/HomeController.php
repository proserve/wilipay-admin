<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $path = route('profile.edit');
        if ($user->hasPermissionTo(config('permission.defaults.view_dashboard'))) $path = route('dashboard');
        if ($user->hasPermissionTo(config('permission.defaults.view_data'))) $path = route('customers.index');
        if ($user->hasPermissionTo(config('permission.defaults.manage_users'))) $path = route('users.index');
        return redirect($path);
    }
}
