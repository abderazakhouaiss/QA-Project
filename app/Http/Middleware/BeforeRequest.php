<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class BeforeRequest
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
        if (!Session::has('_id')){
            //die(Session::get('_id'));
            return redirect('/login')->with(['msg'=>'Votre session est terminée.']);
        }
        return $next($request);
    }
}
