<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function add_post()
    {
        return view('instagram.add_post');
    }

    public function store(Request $request)
    {
        $post=new Post();
        $post->title=$request->title;
        if ($request->has('photo'))
        {
        $post->photo=$request->photo->store('images');
        }
        $post->user_id=Auth::user()->id;
        $post->save();

        return redirect('/');
    }


    public function edit_profile($id)
    {
        $profile=Profile::with('user')->where('user_id',$id)->get();
        return view('instagram.edit_profile',['edit'=>$profile]);

    }

    public function update_profile(Request $request,$id)
    {
        $profil =Profile::find($id);
        $profil->username=$request->username;
        $profil->bio=$request->bio;
        $profil->email=$request->email;
        $profil->phone=$request->phone;
        $profil->gender=$request->gender;
        if ($request->has('photo'))
        {
            $profil->photo=$request->photo->store('images');
        }
        $user=User::find($profil->user_id);
        $user->photo=$profil->photo;
        $user->save();
        $profil->save();
        // session()->flash('message','item was updated successufully');
        return redirect('/profile');
        
    }

  

    public function comments(Request $request)
    {
        $user=User::find(Auth::user()->id);
        $user->can_comment()->attach($request->post_id,['content'=>$request->content,'username'=>Auth::user()->name]);
        return redirect('/');
        
    }



    public function like(Request $request)
    {
        $user=User::find(Auth::user()->id);
       $like= $user->can_like()->where('post_id',$request->post_id)->first();

          if($like)
          {
            $user->can_like()->detach($request->post_id);
          }
          else{
            $user->can_like()->attach($request->post_id);
          
          }
        return redirect('/');
        
    }



    public function follow_page($id)
    {
        $data=[];
        $posts=Post::where('user_id',$id)->get();
        $profile=Profile::where('user_id',$id)->get();
        foreach ($profile as $key => $value) {
            global $data;
            $data=[
                'id'=>$value->user_id,
                'bio'=>$value->bio  ,
                'name'=>$value->username,  
                'photo'=>$value->photo
            ];
        }
        if($id==Auth::user()->id)
        {
           return redirect('profile');
        }
        else{
            return view('instagram.follow_page',['data'=>$posts,"info"=>$data,'follow_number'=>User::find($id)]);
        }
    }

    public function follow(Request $request)
    {

            $user=User::find(Auth::user()->id);
            $follow= $user->can_follow_users()->where('user_id_2',$request->user_id)->first();

            if($follow)
            {
                $user->can_follow_users()->detach($request->user_id);
                return redirect()->route('follow_page', ['id' =>$request->user_id ]);
            }
            else{
                $user->can_follow_users()->attach($request->user_id);
                return redirect()->route('follow_page', ['id' =>$request->user_id ]);
            }
    }
    

}
