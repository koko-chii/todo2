<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController; // 先頭に追記
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryController::class, 'index']);
Route::patch('/todos/update', [TodoController::class, 'update']);
Route::delete('/todos/delete', [TodoController::class, 'destroy']);
Route::get('/', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store']);
