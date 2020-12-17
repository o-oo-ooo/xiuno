<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    /**
     * 首页控制器
     */
    public function index()
    {
        $forumList = view()->shared('forumlist');
        
        $threadlist = Thread::whereIn('forum_id', $forumList->pluck('id')->all())->paginate(2);
        
        $siteStatistics = Cache::rememberForever('statistics', function () {
            return [
                'users' => User::count(),
                'posts' => Thread::count() - Post::count(),
                'threads' => Thread::count(),
                'today_users' => 0,
                'today_posts' => 0,
                'today_threads' => 0,
                'onlines' => 0
            ];
        });
        
        return view('index')
                ->with('threadlist', $threadlist)
                ->with('siteStatistics', $siteStatistics);
    }
}
