<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['name','email','user_id','username','bio','phone','photo','gender'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}
