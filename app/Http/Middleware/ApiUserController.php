<?php

namespace App\Http\Middleware;

use App\Models\Posts;
use Closure;

class ApiUserController
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
        $post = Posts::where('id', $request->id)->get();
        if ($post) {
            return $next($request);
        } else {
            return false;
        }
    }
}
