<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Auth::user()->role->role_name == 'admin' || \Auth::user()->role->role_name == 'supervisor' || \Auth::user()->role->role_name == 'maneger') {
            return $next($request);
        }
        return redirect()->route('home')->with('error', 'أنت غير مفوض لدخول هذه الصفحة');
    }
}
