<?php

namespace App\Http\Middleware;

use App\View\Components\redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission_slug): Response
    {
        foreach(auth()->user()->permissions ?? [] as $permission) {
            if (in_array($permission->slug, [$permission_slug, 'admin'])) {
                return $next($request);
            }
        }
        session()->flash('error', 'Vous n\'avez pas la permission d\'accéder à cette page.');
        return redirect('/');
    }
}
