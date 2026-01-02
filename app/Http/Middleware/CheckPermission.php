<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        if (!auth()->user()->can($permission)) {
            return redirect('/tshirt')->with('error', 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
