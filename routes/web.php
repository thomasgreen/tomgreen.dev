<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\PageHomeController::class)
    ->name('pages.index');

Route::get('/posts', \App\Http\Controllers\PostIndexController::class)
    ->name('posts.index');

Route::get('/posts/{post:slug}', \App\Http\Controllers\PostIndexController::class)
    ->name('posts.show');

Route::get('/projects', \App\Http\Controllers\PageHomeController::class)
    ->name('projects.index');
