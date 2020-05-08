<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SetLanguage
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
        if (Session::get('locale') == 'lt') {
            \App::setLocale('lt');
        } else {
            \App::setLocale('en');
        }
        
        return $next($request);
    }
}
