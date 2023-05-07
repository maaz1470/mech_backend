<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;


Route::prefix('backend')->group(function(){
    Route::post('user-register',[UserController::class, 'userRegister']);
    Route::post('user-login',[UserController::class, 'userLogin']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
