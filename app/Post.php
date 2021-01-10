<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->belongsTo(Like::class);
    }
    public function can_have_comments()
    {
        return $this->belongsToMany(User::class,'comments','post_id','user_id')->withPivot(['content','username','created_at']);
    }
    public function can_have_likes()
    {
        return $this->belongsToMany(User::class,'likes','post_id','user_id')->withPivot(['user_id','post_id']);
    }
    
}
