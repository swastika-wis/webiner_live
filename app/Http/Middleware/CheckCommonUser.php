<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCommonUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard()->check() || session('vendoruser'))
        {
            return $next($request);
        }

            $request->session()->flash('fail','Please login first!');
            return redirect()->route('index');
            
        // dd(!Auth::guard()->check(),!session('vendoruser') );
        // // Check if user logged in with vendoruser or auth user guard
        // if (!Auth::guard()->check() || !session('vendoruser')) {
        
        //     $request->session()->flash('fail','Please login first!');
        //     return redirect()->route('index');
        // }
        

        // return $next($request);
    }
}
