<?php

namespace App\Http\Middleware;

use App\Models\Setting;
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
        if(Setting::get('maintenance') == "true" && auth()->user() && !auth()->user()->isAdmin()) {
            return redirect('/');
        }
        return $next($request);
    }
}
