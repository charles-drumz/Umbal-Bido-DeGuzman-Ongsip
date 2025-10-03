<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

require __DIR__.'/auth.php';

// Task delete route (for Blade form or direct HTTP request)
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// SPA entry point (lahat ng routes papasok dito)
Route::view('/{any}', 'app')->where('any', '.*');

// Optional: root route also points to SPA
Route::get('/', function () {
    return view('app');
});
