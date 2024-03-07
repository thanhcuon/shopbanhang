<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->hasRole('content')) {
            return $next($request);
        }

        return redirect()->route('home'); // Chuyển hướng nếu không có quyền
    }
}
