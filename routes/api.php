<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1/account-center'], function () {
    require base_path('routes/api/v1/account_center.php');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function(){
    return response()->json(['message' => 'API is working fine']);
});