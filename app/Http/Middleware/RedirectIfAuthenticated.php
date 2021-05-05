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
        if (Auth::check() && Auth::user()->isAdmin())
        {
            return redirect()->route('home.index');
        }
        elseif (Auth::check() && Auth::user()->isOrganizer())
        {
            return redirect()->route('organization.index');
        }
        elseif (Auth::check() && Auth::user()->isFamilyAccountant())
        {
            return redirect()->route('family.index');
        }
        elseif (Auth::check() && Auth::user()->isIndividualAccountant())
        {
            return redirect()->route('individual.index');
        }

//        if (Auth::guard($guard)->check()) {
//            return redirect('/home');
//        }

        return $next($request);
    }
}
