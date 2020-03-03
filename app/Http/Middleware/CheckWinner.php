<?php

namespace App\Http\Middleware;

use App\Contest;
use Closure;

class CheckWinner
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
        $contest = Contest::findOrFail($request->route('contest'))->first();

        if (!$contest->winner) {
            return redirect()->route('contests.show', $contest);
        }

        return $next($request);
    }
}
