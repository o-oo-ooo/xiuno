<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }
    
    /**
     * 验证规则
     *
     * @var array
     */
    protected $rules = [
        'email' => 'required|alpha_num|exists:users,name',
        'password' => 'required|max:32'
    ];
    
    /**
     * 用户登录表单
     */
    public function index()
    {
        return view('user.login');
    }
    
    /**
     * 用户登录验证
     */
    public function login(Request $request)
    {
        if ($this->isEmail($request->only('email'))) {
            $this->rules['email'] = 'required|email:rfc|exists:users';
        }
        
        $request->validate($this->rules);
        
        Auth::attempt($request->only('email', 'password'));
        
        $request->session()->regenerate();
        
        return response()->json([
            'code' => 0,
            'message' => trans('app.user_login_successfully')
        ]);
    }
    
    /**
     * 判断用户名是否为邮箱
     *
     * @return bool
     */
    protected function isEmail($request)
    {
        return validator()
                ->make($request, [
                    'email' => 'email:rfc'
                ])->passes();
    }
    
    /**
     * 登出
     *
     * @return string
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        
        return redirect('/');
    }
}
