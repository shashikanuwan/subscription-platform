<?php

use App\Http\Controllers\Post\CreatePostController;
use App\Http\Controllers\Subscription\CreateSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::post('posts', CreatePostController::class)
    ->name('posts.store');

Route::post('subscriptions', CreateSubscriptionController::class)
    ->name('subscriptions.store');
