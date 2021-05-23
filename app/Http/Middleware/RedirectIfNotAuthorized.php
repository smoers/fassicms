<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $permissions)
    {
        $result = false;
        foreach (explode('|',$permissions) as $permission) {
            $result = $result || auth()->user()->can($permission);
        }
        if (!$result)
            return redirect()->route('dashboard');
        return $next($request);
    }
}
