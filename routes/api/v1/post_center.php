<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::Post('/create-post',[PostController::class,'store']);
Route::Patch('/update-post/{post}',[PostController::class,'update']);
Route::Delete('/delete-post/{post}',[PostController::class,'destroy']);