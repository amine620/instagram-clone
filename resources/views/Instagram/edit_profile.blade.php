@extends('layouts.layoutsinsta')
@section('content')

<main class="edit-profile">
    <section class="profile-form">
        @foreach ($edit as $item)
        <header class="profile-form__header">
            <div class="profile-form__avatar-container">
                <img 
                    src="{{asset('storage/'.$item->photo)}}"
                    class="profile-form__avatar"
                />
            </div>
            <h4 class="profile-form__title">{{$item->name}}</h4>
        </header>
        <form action="{{route('update',['id'=>$item->id])}}" method="post" class="edit-profile__form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                
            <div class="edit-profile__form-row">
                <label for="username" class="edit-profile__label">
                    Username
                </label>
                <input 
                    type="text"
                    id="username"
                    class="edit-profile__input"
                    name="username"
                    value="{{$item->username}}"
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="bio" class="edit-profile__label">
                    Bio
                </label>
                <textarea name="bio" id="bio" class="edit-profile__textarea">{{$item->bio}}</textarea>
            </div>
            <div class="edit-profile__form-row">
                <label for="email" class="edit-profile__label">
                    Email
                </label>
                <input 
                    type="email"
                    class="edit-profile__input"
                    id="email"
                    value="{{$item->email}}"
                    name="email"
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="phone-number" class="edit-profile__label">
                    Phone Number
                </label>
                <input 
                    type="text"
                    class="edit-profile__input"
                    id="phone-number"
                    name="phone"
                    value="{{$item->phone}}"
                />
            </div>
            <div class="edit-profile__form-row">
                <label name="gender" for="gender" class="edit-profile__label">Gender</label>
                <select id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="edit-profile__form-row">
                <label for="website" class="edit-profile__label">
                    Avatar
                </label>
                <input
                    type="file"
                    id="photo"
                    class="edit-profile__input"
                    name="photo"
                    value="{{$item->photo}}"
                />
            </div>
            <div class="edit-profile__form-row">
                <label class="edit-profile__label"></label>
                <input type="submit" value="Submit">
            </div>
        </form>
            @endforeach
             

    </section>
</main>


@endsection