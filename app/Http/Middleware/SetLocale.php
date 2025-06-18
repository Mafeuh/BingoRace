<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        logger('SESSION LOCALE: ' . session()->get('locale'));
        logger('CONFIG LOCALE: ' . config('app.locale'));

        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale', config('app.locale')));
        }

        logger('CURRENT LOCALE: ' . app()->getLocale());

        return $next($request);
    }
}
