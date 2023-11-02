<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole1or2
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    * @param  int  $roles
    * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        // Verifica si el usuario tiene al menos uno de los roles especificados
        foreach ($roles as $role) {
            if ($user->role_id == $role) {
                return $next($request);
            }
        }
        $url = $request->url();
        return redirect('home')->with('error', "Access denied to $url");
    }
}
