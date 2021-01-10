<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware'=>"auth"], function(){

    Route::get('/',[PostsController::class,'feed'])->name('feed');
    Route::get('/profile',[PostsController::class,'profile'])->name('profile');
    Route::get('/edit_profile/{id}',[PostsController::class,'edit_profile'])->name('edit_profile');
    Route::get('/add_post',[PostsController::class,'add_post'])->name('add_post');
    Route::post('/store', [UserController::class,'store'])->name('store');
    Route::put('/update/{id}',[PostsController::class,'update_profile'])->name('update');
    Route::post('comment',[UserController::class,'comments'])->name('comment');
    Route::post('like',[UserController::class,'like'])->name('like');
    Route::get('follow_page/{id}',[UserController::class,'follow_page'])->name('follow_page');
    Route::post('follow',[UserController::class,'follow'])->name('follow');

});


