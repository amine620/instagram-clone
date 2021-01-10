@extends('layouts.layoutsinsta')
@section('content')

<main class="edit-profile">
    <section class="profile-form">
        <header class="profile-form__header">
            <div class="profile-form__avatar-container">
                <img 
                    src="{{asset('instagram/images/avatar.jpg')}}"
                    class="profile-form__avatar"
                />
            </div>
            <h4 class="profile-form__title">{{Auth::user()->name}}</h4>
        </header>
        <form action="{{route('store')}}"  class="edit-profile__form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="edit-profile__form-row">
                <label for="title" class="edit-profile__label">
                    Title
                </label>
                <input 
                    type="text"
                    id="title"
                    class="edit-profile__input"
                    name="title"
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="website" class="edit-profile__label">
                    Picture
                </label>
                <input
                    type="file"
                    id="photo"
                    class="edit-profile__input"
                    name="photo"
                />
            </div>
        
            <div class="edit-profile__form-row">
                <label class="edit-profile__label"></label>
                <input type="submit" value="Add new post">
            </div>
        </form>
    </section>
</main>


@endsection