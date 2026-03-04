<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::patch('/categories/update', [CategoryController::class, 'update']);
Route::delete('/categories/delete', [CategoryController::class, 'destroy']);

Route::get('/', [TodoController::class, 'index'])->name('todo.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todo.store');
Route::patch('/todos/update', [TodoController::class, 'update']);
Route::delete('/todos/delete', [TodoController::class, 'destroy']);
Route::get('/todos/search', [TodoController::class, 'search']);
