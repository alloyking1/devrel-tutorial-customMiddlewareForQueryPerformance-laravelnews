<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])
    ->name('posts.index');