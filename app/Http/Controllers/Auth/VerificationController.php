<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	// 所有的控制器动作都需要登录有才能访问
        $this->middleware('auth');
        // 只有 verify 动作使用 signed 中间件进行认证 （signed 中间件是一种由框架提供的很方便的 URL 签名认证方式）
        $this->middleware('signed')->only('verify');
        // 对 verify 和 resend 动作做了频率限制， throttle 中间件是框架提供的访问频率限制功能
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
