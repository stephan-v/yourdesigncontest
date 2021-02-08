<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class DatabaseTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request The incoming request.
     * @param Closure $next The next middleware to pass the request to.
     * @return mixed
     * @throws Throwable Thrown when the transaction could not be completed.
     */
    public function handle(Request $request, Closure $next)
    {
        DB::beginTransaction();

        try {
            $response = $next($request);

            if ($response->exception) {
                throw $response->exception;
            }
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        if (!$response->exception) {
            DB::commit();
        }

        return $response;
    }
}
