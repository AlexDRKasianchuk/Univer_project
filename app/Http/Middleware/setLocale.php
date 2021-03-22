<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App; 
use Closure;
use Illuminate\Http\Request;

class setLocale
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
        App::setLocale( session('locale'));
       
        return $next($request);
    }
}
