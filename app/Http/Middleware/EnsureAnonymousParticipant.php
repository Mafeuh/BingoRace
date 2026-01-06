<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AnonymousParticipant;

class EnsureAnonymousParticipant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) {
            return $next($request);
        }

        $key = 'ap_i';
        $anonId = session()->get($key);

        if($anonId) {
            $participant = AnonymousParticipant::find($anonId);

            if($participant) {
                $request->attributes->set('current_anon_participant', $participant);
                return $next($request);
            }
        }
        $participant = AnonymousParticipant::create([
            'username' => 'Guest_' . uniqid(),
        ]);

        session([$key => $participant->id]);

        $request->attributes->set('current_anon_participant', $participant);

        session(['next_req' => $request->fullUrl()]);

        return redirect('/setname');
    }
}
