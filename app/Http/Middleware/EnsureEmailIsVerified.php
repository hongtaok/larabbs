<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    /**
	 * 三个判断：
	 * 1. 如果用户已经登录
	 * 2. 并且还未认证 email
	 * 3. 并且访问的不是 email 验证相关 url 或者退出的 url
     */
    public function handle($request, Closure $next)
    {
    	if ($request->user() && !$request->user()->hasVerifiedEmail() && !$request->is('email/*', 'logout')) {
    		return $request->expectsJson() ? abort(403, 'Your email address is not verified.') : redirect()->route('verification.notice');
		}

        return $next($request);
    }
}
