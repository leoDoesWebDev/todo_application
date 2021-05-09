<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tasks', [TodoController::class, 'index']);
Route::post('/task', [TodoController::class, 'store']);
Route::get('/task/{id}', [TodoController::class, 'show']);
Route::delete('/task/{id}', [TodoController::class, 'destroy']);
Route::patch('/task/{id}', [TodoController::class, 'update']);

Route::patch('/task-status/{id}', [TodoStatusController::class, 'update']);
