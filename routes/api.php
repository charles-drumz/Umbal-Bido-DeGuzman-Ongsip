<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\ProfileController; // <-- tama kung nasa Controllers lang
use App\Http\Controllers\ImportUsersController;
use App\Http\Controllers\PostController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('posts', PostController::class);
    // Task CRUD
    Route::apiResource('tasks', TaskController::class);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // ✅ Profile Routes
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // ✅ Users Import
    Route::post('/users/import', [ImportUsersController::class, 'import']);
});
