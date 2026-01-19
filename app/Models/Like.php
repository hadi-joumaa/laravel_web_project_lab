<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Like extends Model
{
    //
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'post_id'
    ];
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
     public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
