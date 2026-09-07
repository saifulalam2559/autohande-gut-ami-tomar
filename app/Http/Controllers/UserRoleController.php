<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {


        if (auth()->user()->role === 'admin') {

            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'seller') {

            return redirect()->route('seller.dashboard');
        } elseif (auth()->user()->role === 'customer') {

            return redirect()->route('customer.dashboard');
        } else {

            return redirect()->route('/')->with('error', 'Email and password are wrong');
        }
    }

    public function changeStatus(Request $request) {

        $user = User::find($request->user_id);

        $user->status = $request->status;

        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function adminDashboard() {

        return view('backend.admin.index');
    }

    public function adminProfile() {

        return view('backend.admin.profile');
    }

    public function sellerDashboard() {

        return view('backend.seller.index');
    }

    public function sellerProfile() {

        return view('backend.seller.profile');
    }

    public function customerDashboard() {
        
         $user = Auth::user();
        return view('backend.customer.index', compact('user'));
    }

    // Auth logout
    public function logout(Request $request) {



        $request->session()->invalidate();  // it destry the previous session during the new login
        Auth::logout();
       // return view('frontend.home.index')->with('success', 'User Logout');

          return redirect()->route('login')->with(Auth::logout());
    }

}