<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
Route::put('/task/update/{id}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
