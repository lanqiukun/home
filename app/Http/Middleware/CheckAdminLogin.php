<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogin
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


        if (!auth() -> guard('myguard') ->check())
        {
            session(['attempt_to' => $request->route()->getName()]);
            return redirect(route('admin.login'))->withErrors('请登录');
        }


        return $next($request);
    }
}
