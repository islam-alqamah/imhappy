<?php

namespace App\Http\Middleware;

use Closure;

class Subscribed
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
        if ($request->user() && ! (currentTeam()->Subscribed('default') || currentTeam()->onTrial())) {
            return redirect()->route('subscription.plans');
        }

        return $next($request);
    }
}
