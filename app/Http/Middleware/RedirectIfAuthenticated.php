<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return (strpos($this->roles(), 'admin') !== false) ? 
                redirect('admin') : redirect($this->roles());
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
