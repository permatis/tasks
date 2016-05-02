<?php

namespace App\Http\Middleware;

use Closure;

class ActivationMiddleware
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
        if(auth()->user()->confirmed == 0)
        {
            return (request()->segment(1) != $this->roles() || (request()->segment(2) != null)) ? 
                view('errors.404') : $next($request); 
        }

        return $next($request);
    }

    protected function roles()
    {
        return strtolower(
            auth()->user()->roles()->first()->name
        );
    }
}
