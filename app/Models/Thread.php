<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'forum_id',
        'subject',
        'user_id',
        'first_pid',
        'last_pid',
        'last_uid',
        'ip',
        'posts',
    ];
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
    
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    
    public function lastUser()
    {
        return $this->hasOne(User::class, 'id', 'last_uid');
    }
    
    public function firstPost()
    {
        $postId = $this->first_pid;
        
        return $this->post->first(function ($value) use ($postId) {
            return $value->id == $postId;
        });
    }
}
