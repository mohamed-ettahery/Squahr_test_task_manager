<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    Route::post('tasks/filter', [TaskController::class, 'filterBy']);
    Route::post('tasks/sort', [TaskController::class, 'sortBy']);
    Route::post('/logout', [UserController::class, 'logout']);
});
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
