<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
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
        if (session()->has('role') && session('role') == 'admin') {
            return redirect('consoles');
        } else if (session()->has('role') && session('role') == 'user') {
            return redirect()->route('home');
        } else {
            return $next($request);
        }
    }
}
