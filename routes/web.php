<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\user\AdminController;
use App\Http\Controllers\user\LoginUserController;
use App\Http\Controllers\user\RegisterUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// just authenticated user can change posts
Route::group(['middleware' => 'auth'],function(){
    Route::resource('/posts',PostController::class,['except' => ['index', 'show']]);
    Route::post('/logout', [LoginUserController::class,'logout'])->name('logout');

});
Route::resource('/posts',PostController::class,['only' => ['index', 'show']]);

// admin routes
Route::group(['middleware'=> 'is-admin'],function(){

 Route::get('admin',[AdminController::class, 'index'])->middleware('is-admin')->name('admin');

 Route::get('/admin/posts/{post}/edit',[AdminPostController::class,'edit'])->name('admin.posts.edit');
 Route::put('/admin/posts/{post}',[AdminPostController::class,'update'])->name('admin.posts.update');
 Route::delete('/admin/posts/{post}',[AdminPostController::class,'destroy'])->name('admin.posts.destroy');


});
// all guest users vsited routes
Route::group(['middleware' => 'guest'],function(){
Route::get('/register', [RegisterUserController::class,'register'])->name('register');
Route::post('/register', [RegisterUserController::class,'store'])->name('register.store');
Route::get('/login', [LoginUserController::class,'login'])->name('login');
Route::post('/login', [LoginUserController::class,'store'])->name('login.store');
});

