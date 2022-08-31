<?php

use App\Http\Controllers\ResolutionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;


Route::middleware('auth:sanctum')->group( function () {
    Route::get('addfriend/{id}', [UserController::class, 'addFriend']);
    Route::get('removefriend/{id}', [UserController::class, 'removeFriend']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::apiResource('trees', TreeController::class);
Route::get('/current-tree/{id}', [TreeController::class, 'currentTree']);
Route::apiResource('resolutions', ResolutionController::class);
Route::get('/current-resolution/{id}', [ResolutionController::class, 'currentResolution']);
Route::apiResource('todos', TodoController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('categories', CategoryController::class);

Route::put('trees/status/{id}', [TreeController::class, 'changeStatus']);
Route::put('resolutions/tree/{id}', [ResolutionController::class, 'changeTree']);
Route::put('resolutions/status/{id}', [ResolutionController::class, 'changeStatus']);

Route::put('resolutions/onhold/{id}', [ResolutionController::class, 'putOnHold']);
Route::put('resolutions/tree/{id}', [ResolutionController::class, 'changeTree']);

Route::put('todos/status/{id}', [TodoController::class, 'changeStatus']);
Route::put('user/avatar/{id}', [UserController::class, 'changeAvatar']);

Route::get('/users/search/{name}', [UserController::class, 'search']);


Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    
});