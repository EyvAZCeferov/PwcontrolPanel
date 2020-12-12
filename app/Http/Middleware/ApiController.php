<?php

namespace App\Http\Middleware;

use Closure;
use Kreait\Firebase\Factory;

class ApiController
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
        $verify = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->getUser($request->uid);
        if ($verify) {
            if ($verify->email !== null) {
                return $next($request);
            } else {
                return 'Error Request';
            }
        } else {
            return 'Error Request';
        }
    }
}
