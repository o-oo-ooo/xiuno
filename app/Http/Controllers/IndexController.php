<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页控制器
     */
    public function index()
    {
        return view('index')
                ->with('threadlist', 0)
                ->with('gid', 0)
                ->with('fid', 0)
                ->with('conf', [])
                ->with('runtime', [
                    'threads' => 0,
                    'posts' => 0,
                    'users' => 0,
                    'onlines' => 0,
                ])
                ->with('forumlist_show', [])
                ->with('pagination', 0);
    }
}
