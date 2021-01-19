<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $name = $request->user()->role->name;
        if (is_array($roles)) {
            foreach ($roles as $key => $role) {
                if ($name === $role) {
                    return $next($request);
                }
            }
        }
        if ($roles === $name) {
            return $next($request);
        }

        $message = 'Anda tidak memiliki akses ke halaman tersebut!';

        return redirect()->back()->with($message);
    }
}
