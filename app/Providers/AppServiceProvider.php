<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 导航栏栏目列表
        $group_id = Auth::user() ? Auth::user()->group_id : 0;
        $forums = Forum::all()->reject(function ($value) {
            return $value->accesson && !$value->accesslist[$group_id]['allowread'];
        });
        
        View::share('forumlist', $forums);
        View::share('forumarr', $forums->pluck('name', 'id')->toJson(JSON_UNESCAPED_UNICODE));
    }
}
