<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

Route::get('/', [AuthController::class, 'HomePage'])->name('index');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'StoreUser'])->name('register.store');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/posts/create', [PostController::class, 'CreatePost'])->name('posts.create');
Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google-redirect');
Route::get('/auth/google-callback', [GoogleController::class, 'googleCallback']);
Route::get('/profile/{id}', [ProfileController::class, 'profilePage'])->name('profile');
Route::post('/like',[LikeController::class,'likeToggle'])->name('like');
Route::get('/post/delete/{id}',[PostController::class,'deletePost']);
Route::get('/logout',[PostController::class,'logout'])->name('logout');
Route::post('/addFriend',[FriendController::class,'addFriend'])->name('addFriend');
Route::post('/addFriend',[FriendController::class,'addFrienddecide'])->name('addFriend');
Route::get('/notifications',[NotificationController::class,'notificationPage'])->name('notifications');
