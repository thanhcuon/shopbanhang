<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
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
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Kiểm tra vai trò của người dùng
            $user = Auth::user();
            if ($user->hasRole('admin') || $user->hasRole('developer') || $user->hasRole('content')) {
                // Cho phép truy cập nếu có vai trò là admin, developer hoặc content
                return $next($request);
            }
        }

        // Nếu không có vai trò phù hợp, chuyển hướng về trang chủ
        return redirect('/');
    }
}
