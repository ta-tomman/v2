<?php

namespace App\Http\Middleware;

use App\Service\Authentication\User;
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
        if ($request->session()->has('auth')) {
            return $next($request);
        }

        $rememberToken = $request->cookie('persistent-token');
        if ($rememberToken) {
            $user = User::getByRememberToken($rememberToken);
            if ($user) {
                $request->session()->put('auth', $user);
                return $next($request);
            }
        }

        $request->session()->put('auth-originalUrl', $request->fullUrl());
        // TODO: test fetch/ServiceWorker
        if ($request->ajax()) {
            return response('UNAUTHORIZED', 401);
        } else {
            return redirect('login');
        }
    }
}
