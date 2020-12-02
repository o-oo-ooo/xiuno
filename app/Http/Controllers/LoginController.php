<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
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
    public function login()
    {
        return '';
    }
}
