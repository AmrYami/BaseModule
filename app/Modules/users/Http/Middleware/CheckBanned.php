<?php

namespace Users\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckBanned
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
        if (Auth::check() && Auth::user()->status == 0) {
            Auth::logout();
            return redirect()->route('login')->withMessage('Your account waiting for activation');
        }else if (Auth::check() && Auth::user()->freeze == 1) {
            Auth::logout();
            return redirect()->route('login')->withMessage('Your account has been blocked');
        }else if (Auth::check() && Auth::user()->banned_until && now()->lessThan(Auth::user()->banned_until)) {
            $banned_days = now()->diffInDays(Auth::user()->banned_until);
            Auth::logout();
            if ($banned_days > 0)
                $message = 'Your account has been suspended for ' . $banned_days . ' ' . str_plural('day', $banned_days) . '. Please contact administrator.';
            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
