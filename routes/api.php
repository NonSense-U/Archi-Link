<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {

    Route::prefix('account-center')->group(function () {
        require base_path('routes/api/v1/account_center.php');
    });

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::prefix('post-center')->group(function () {
            require base_path('routes/api/v1/post_center.php');
        });
        
        Route::prefix('user-relations')->group(function () {
            require base_path('routes/api/v1/following_sys.php');
        });
    });
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working fine']);
});
