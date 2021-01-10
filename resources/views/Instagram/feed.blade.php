@extends('layouts.layoutsinsta')
@section('content')

<main class="feed">
    @foreach($dataall as $feed)
    <section class="photo">
        <header class="photo__header">
            <div class="photo__header-column">
                <img
                    class="photo__avatar"
                    src="{{asset('storage/'.$feed->user->photo)}}"
                />
            </div>
            <div class="photo__header-column">
                <span class="photo__username">
                    <a href="{{route('follow_page',['id'=>$feed->user->id])}}">
                        {{$feed->user->name}}
                    </a>
                </span>
                <span class="photo__location">{{$feed->title}}</span>
            </div>
        </header>
        <div class="photo__file-container">
            <img
                class="photo__file"
                src="{{asset('storage/'.$feed->photo)}}"
            />
        </div>
        <div class="photo__info">
            <div class="photo__icons" style="display: flex">
                <form action="{{route('like')}}" method="post">
                        @csrf
                        <input  type="hidden" name="post_id" value="{{$feed->id}}">
                    @if (Auth::user()->can_like()->where('post_id',$feed->id)->first())  
                    <button style="border:none" type="submit" id="completed-task" class="fabutton btn-read">
                        <i id="heart" class="fa fa-heart" style="color:red;font-size:24px;margin-right:10px"></i>
                    </button>
                    @else  
                    <button style="border:none" type="submit" id="completed-task" class="fabutton btn-white">
                        <i id="heart" class="fa fa-heart-o" style="font-size:24px;margin-right:10px"></i>
                    </button>
                    @endif
                </form>
                <span class="photo__icon">
                    <i class="fa fa-comment-o fa-lg"></i>
                     <span>{{$feed->can_have_comments->count()}}</span>
                </span>
            </div>
            <span class="photo__likes">{{$feed->can_have_likes->count()}} likes</span>
            <ul class="photo__comments">
                @foreach ($feed->can_have_comments as $item)  
                <li class="photo__comment">
                    <span class="photo__comment-author">{{$item->pivot->username}}</span>
                    <br>
                    <span>{{$item->pivot->content}}</span>

                </li>
                @endforeach
            </ul>
            <span class="photo__time-ago">{{$feed->created_at->diffForHumans()}}</span>
            <div class="photo__add-comment-container">
              <form action="{{route('comment')}}" method="post">
                  @csrf
                  <input type="hidden" name='post_id' value={{$feed->id}}>
                  <input type="text" placeholder="add comment..." name="content" class="photo__add-comment">
              </form>

                <i class="fa fa-ellipsis-h"></i>
            </div>
        </div>
    </section>
    @endforeach
</main>
    
@endsection