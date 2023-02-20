<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActive
{
    // /**
    //  * Handle an incoming request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    //  * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    //  */
    public function handle(Request $request, Closure $next)
    {
        if(auth()-> check() && auth()->user()->status == 'blocked') {
            auth()->logout();
            return redirect()->route('login')->with('warning','akun anda tidak aktif');
        }
        return $next($request);
    }
}
