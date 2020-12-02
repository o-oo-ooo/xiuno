<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Forum;

class ShareForumList
{
    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new error binder instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $view
     * @return void
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->view->share(
            'forumlist', $this->getForumList($request->user())
        );
        
        return $next($request);
    }
    
    /**
     * 获取栏目列表
     *
     * @return array
     */
    protected function getForumList($user)
    {
        $group_id = $user ? $user->group_id : 0;
        
        return Forum::all()->reject(function ($value) {
            return $value->accesson && !$value->accesslist[$group_id]['allowread'];
        });
    }
    
}
