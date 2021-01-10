<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function feed()
    {
        $feed=Post::with(["can_have_comments","can_have_likes"])->orderBy('created_at','desc')->get();
        return view('instagram.feed',['dataall'=>$feed]);
    }

    public function profile()
    {
        $data=[];
        $posts=Post::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $profile=Profile::where('user_id',Auth::user()->id)->get();
        foreach ($profile as $key => $value) {
            global $data;
            $data=[
                'bio'=>$value->bio  ,
                'name'=>$value->username,  
                'photo'=>$value->photo
            ];
        }
        return view('instagram.profile',['data'=>$posts,"info"=>$data,'follow_number'=>User::find(Auth::user()->id)]);
    }

}

