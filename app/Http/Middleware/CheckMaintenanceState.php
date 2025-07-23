<?php

namespace App\Http\Middleware;

use App\View\Components\redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceState
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(config('app.maintenance_mode') && auth()->user() && !auth()->user()->isAdmin()) {
            return redirect('/');
        }
        return $next($request);
    }
}
