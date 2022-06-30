<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUserLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('role')) {
            return redirect('login')->with('failed', 'You must log in first!');
        } else if (session('role') == 'admin') {
            return redirect('consoles');
        } else if (session('role') == 'user') {
            return $next($request);
        }
    }
}
