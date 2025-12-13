<?php

use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

Route::post('/follow/{username}', [FollowController::class, 'follow']);
Route::post('/block/{username}', [FollowController::class, 'block']);
Route::delete('/unfollow/{username}', [FollowController::class, 'unfollow']);