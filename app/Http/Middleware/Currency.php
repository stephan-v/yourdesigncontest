<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * The Currency middleware sets the user preferred currency for the application.
 */
class Currency
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
        $currency = Auth::check() ? $request->user()->currency : 'USD';

        app()->singleton(\Money\Currency::class, function() use ($currency) {
            return new \Money\Currency($currency);
        });

        return $next($request);
    }
}
