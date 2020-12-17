<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attach extends Model
{
    use HasFactory;
    
    /**
     * 可填充属性
     *
     * @var array
     */
    protected $fillable = [
        'thread_id',
        'post_id',
        'user_id',
        'filesize',
        'width',
        'height',
        'filename',
        'orgfilename',
        'filetype',
        'comment',
        'downloads',
        'isimage',
    ];
}
