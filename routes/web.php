<?php

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

Route::get('/', \App\Http\Controllers\PageHomeController::class)
    ->name('pages.index');

Route::get('/posts', \App\Http\Controllers\PageHomeController::class)
    ->name('posts.index');

Route::get('/projects', \App\Http\Controllers\PageHomeController::class)
    ->name('projects.index');
