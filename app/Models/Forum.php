<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    
    /**
     * 获取与栏目相关的访问规则
     *
     * @return array
     */
    public function forumAccess()
    {
        return $this->hasMany(ForumAccess::class);
    }
    
    /**
     * 获取论坛icon
     */
    public function getIconAttribute($value)
    {
        return $value ? asset('forum/' . $this->id . ',png') : asset('image/forum.png');
    }
    
    /**
     * 获得板块访问列表
     *
     * @return array
     */
    public function getAccesslistAttribute($value)
    {
        return $this->accesson ? $this->forumAccess() : [];
    }
    
    /**
     * 获取板块的版主列表
     *
     * @return array
     */
    public function getModuidsAttribute($value)
    {
        return $value ? User::find(explode(',', $value)) : [];
    }
    
    /**
     * 获得可访问板块
     *
     * @return Collection
     */
    public static function allowForum($user, $index)
    {
        return static::all()->reject(function ($value) use ($user) {
            return $value->accesson && !$value->accesslist[$user->group_id][$index];
        });
    }
    
    /**
     * 获取板块主题
     *
     * @return string
     */
    public function thread()
    {
        return $this->hasMany(Thread::class, 'forum_id');
    }
    
}
