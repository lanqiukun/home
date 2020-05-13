<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Node;

class GrantUserNode
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

        
        if (!config('rbac.enabled'))
        {
            session(['user_node' => Node::all() -> pluck('route', 'id') ->toArray()]);
            return $next($request);
        }

        $userModel = auth() -> user();

        if ($userModel->username !== config('rbac.root'))
        {
            $roleModel = $userModel -> role;
            $valid_node = $roleModel->nodes();
        } else {
            $valid_node = Node::all();
        }

        // $current_route = \Route::current()->getActionName();
        
        $current_route = $request->route()->getName();

        $nodes = $valid_node -> pluck('route', 'id') ->toArray();

        session(['user_node' => $nodes]);


        if (in_array($current_route, config('rbac.allow_route')) || in_array($current_route, session('user_node')))
            return $next($request);
        else
            abort(403);



    }
}


