<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageItemController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/user', [AuthController::class, 'getUser']);

Route::get('/page-items', [PageItemController::class, 'index']);
Route::get('/page-items/{id}', [PageItemController::class, 'show']);
Route::post('/page-items', [PageItemController::class, 'store']);
Route::put('/page-items/{id}', [PageItemController::class, 'update']);
Route::delete('/page-items/{id}', [PageItemController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
