<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;


Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/login', [LoginController::class,'postlogin'])->name('post.login');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/signup',[LoginController::class,'signup'])->name('signup');
Route::post('/signup',[LoginController::class,'register'])->name('register');

Route::middleware('auth')->group(function() {

    Route::get('/',[ChatController::class,'home'])->name('home');
    Route::get('/profile/{id}',[UserController::class,'edit'])->name('profile.edit');
    Route::post('/profile/{id}',[UserController::class,'update'])->name('profile.update');
    Route::get('/contacts',[UserController::class,'contacts'])->name('contacts');
    Route::get('/contact/{id}/delete',[UserController::class,'delete'])->name('contact.delete');

    Route::get('/chat/{id?}',[ChatController::class,'index'])->name('chat.index');
});