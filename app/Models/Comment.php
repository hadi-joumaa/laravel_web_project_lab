<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'post_id',
        'parent_id',
        'content'
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
