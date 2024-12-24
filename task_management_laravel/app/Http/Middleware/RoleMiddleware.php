<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // if (Auth::check())
        // {
        //     $permissions = json_decode(Auth::user()->permission_route, true);

        //     if (in_array($permission, $permissions))
        //     {
                return $next($request);
        //     }
        // }

        // abort(403, 'Unauthorized action.');
    }
}
