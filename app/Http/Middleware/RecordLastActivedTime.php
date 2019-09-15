<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RecordLastActivedTime
{

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Auth::user()->recordLastActivedAt();
        }
        return $next($request);
    }



}
