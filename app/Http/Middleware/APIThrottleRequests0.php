<?php

namespace App\Http\Middleware;

use Closure;

class APIThrottleRequests0 extends \Illuminate\Routing\Middleware\ThrottleRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    protected function buildResponse($key, $maxAttempts)
    {
        return 429;
    }
}
