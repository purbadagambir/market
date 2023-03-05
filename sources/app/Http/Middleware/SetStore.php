<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class SetStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user() && session('store'))
        {
            return $next($request);
        }
        else
        {
            return Redirect('select_store');
        }
    }
}
