<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('dashboard', function () {
    return redirect()->route('kanban');
})->name('dashboard');

Route::get('kanban', function () {
    return Inertia::render('Kanban');
})->middleware(['auth', 'verified'])->name('kanban');


Route::get('/api/tasks', [TaskController::class, 'index']);
Route::post('/api/tasks', [TaskController::class, 'store']);
Route::put('/api/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/api/tasks/{task}', [TaskController::class, 'destroy']);
Route::post('/api/tasks/reorder', [TaskController::class, 'reorder']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
