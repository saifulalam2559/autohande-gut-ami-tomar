<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard or redirect based on user role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check the user's role and redirect accordingly
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'seller') {
            return redirect()->route('seller.dashboard');
        } elseif ($role === 'customer') {
            return redirect()->route('customer.dashboard');
        } else {
            return redirect('/')->with('error', 'Unauthorized access');
        }
    }
}