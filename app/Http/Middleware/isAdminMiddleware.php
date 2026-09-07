<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdminMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {


        if (auth()->user()->role === 'admin') {

            return $next($request);
            
        } elseif (auth()->user()->role === 'seller') {

            return redirect()->route('seller.dashboard');
            
        } elseif (auth()->user()->role === 'customer') {

            return redirect()->route('customer.dashboard');
            
        } else {

            return redirect()->route(auth()->user()->role)->with('error', 'You do not have access here !!');
        }
    }

}