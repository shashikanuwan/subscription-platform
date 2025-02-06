<?php

use App\Http\Controllers\Post\CreatePostController;
use Illuminate\Support\Facades\Route;

Route::post('posts', CreatePostController::class)
    ->name('posts.store');
