<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->role_id == $role) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
