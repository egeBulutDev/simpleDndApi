<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/page-items', [PageItemController::class, 'index']);
Route::get('/page-items/{id}', [PageItemController::class, 'show']);
Route::post('/page-items', [PageItemController::class, 'store']);
Route::put('/page-items/{id}', [PageItemController::class, 'update']);
Route::delete('/page-items/{id}', [PageItemController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
