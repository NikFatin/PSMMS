<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = auth()->user();

        if($role == 'coordinator' && auth()->user()->role_id != 1){
            abort (code: 403);
        }
        
        if($role == 'student' && auth()->user()->role_id != 2){
            abort (code: 403);
        }

        if($role == 'supervisor' && auth()->user()->role_id != 3){
            abort (code: 403);
        }

        return $next($request);
    }
}
