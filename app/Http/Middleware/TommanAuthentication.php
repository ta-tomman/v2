<?php

namespace App\Http\Middleware;

use Closure;

class TommanAuthentication
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
        if (!$request->session()->has('auth')) {
            $request->session()->put('auth-originalUrl', '');
            // TODO: test fetch/ServiceWorker
            if ($request->ajax()) {
                return response('UNAUTHORIZED', 401);
            } else {
                return redirect('login');
            }
        }

        return $next($request);
    }
}
