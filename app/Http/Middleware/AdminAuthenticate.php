<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuthenticate
{

    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(!Auth::guard('admin')->check()) {
            return redirect('hr80c4037');
        }
        return $next($request);
    }
}
