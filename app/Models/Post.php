<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\PostObserver;

class Post extends Model
{
    use HasFactory;
    
    /**
     * 批量赋值属性
     *
     * @var array
     */
    protected $fillable = [
        'thread_id',
        'is_first',
        'user_id',
        'ip',
        'message',
        'message_format',
        'ip',
        'doctype',
    ];
    
    /**
     * 获取关联用户
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function attach()
    {
        return $this->hasMany(Attach::class);
    }
    
    public function forum()
    {
        return $this->hasOneThrough(Forum::class, Thread::class, 'id', 'id', 'thread_id', 'forum_id');
    }
    
    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }
}
