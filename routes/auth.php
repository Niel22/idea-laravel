<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IdeaController;

Route::group(['middleware'=> 'guest'], function(){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    
    Route::post('/register', [AuthController::class, 'create'])->name('register');
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->withoutMiddleware('guest');
});