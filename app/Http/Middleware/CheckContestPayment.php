<?php

namespace App\Http\Middleware;

use Closure;

class CheckContestPayment
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
        $contest = $request->route('contest');

        if ($contest->isNotPaidFor()) {
            if ($request->user() && $request->user()->can('manage', $contest)) {
                $this->setUnpaidContestWarning();
            }

            return redirect()->route('home');
        }

        return $next($request);
    }

    /**
     * Set a sweet alert flash message warning the owner the contest has not been paid yet.
     */
    private function setUnpaidContestWarning()
    {
        $title = 'Your contest has not been paid for yet.';
        $code = 'In case if this is incorrect please contact us <a href="' . route('contact.form') . '">here.</a>';

        alert()->html($title, $code, 'warning')->autoClose(false);
    }
}
