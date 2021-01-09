<?php

namespace App\Http\Middleware\Roles;

use Closure;
use Illuminate\Support\Facades\Auth;

class DeletedController
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admins')->user()->role == 3 || Auth::guard('admins')->user()->role == 1) {
            return $next($request);
        } else {
            return redirect(route('profile', Auth::guard('admins')->user()->id));
        }
    }
}
