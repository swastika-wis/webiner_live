<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckWebUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user logged in with 'webuser' guard
        if (!Auth::guard()->check()) {
        
            $request->session()->flash('fail','Please login first!');
            return redirect()->route('index');
        }
        

        return $next($request);
    }
}
