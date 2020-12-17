<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Thread;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->message_format = $post->message;
    }
    
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        if ($post->is_first) {
            
        } else {
            $post->floor = $post->thread->posts + 2;
            $status = $post->thread->update([
                'posts' => DB::raw('posts+1'), 
                'last_pid' => $post->id, 
                'last_uid' => $post->user_id
            ]);
            $post->user->increment('posts');
            $post->forum->increment('today_posts');
        }
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
