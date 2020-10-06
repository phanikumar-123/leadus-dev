<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserVerfication
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
        if (Auth::check()) {
            if (Gate::allows('admin-access')) {
                return $next($request);
            } else {
                $user = $request->user();
                $path = $request->path();

                $email_verified = ($user->hasVerifiedEmail());
                $has_active_plan = ($user->active_plan != null && (strtotime($user->plan_expires_on) > strtotime('now')));

                // Logged in, but email not verfied
                if (!$email_verified && $path != 'otp') {
                    return redirect('/otp');
                    // Logged in, email verfied, no active plan
                } else if ($email_verified && !$has_active_plan && $path != 'plans') {
                    return redirect('/plans');
                    // Logged in, email verfied, has active plan
                } else if (($path == 'otp' || $path == 'plans') && $email_verified && $has_active_plan) {
                    return redirect('/home');
                } else {
                    return $next($request);
                }
            }
        }
        return redirect('/');
    }
}
