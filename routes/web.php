<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/task/create', [TaskController::class, 'store'])->name('task.create');
Route::get('/task/add', [TaskController::class, 'create'])->name('addtask');
Route::get('/task/{task}', [TaskController::class, 'show']);
Route::get('/task/edit/{task}', [TaskController::class, 'edit']);
Route::put('/task/edit/{task}', [TaskController::class, 'update']);
Route::delete('/task/delete/{task}', [TaskController::class, 'destroy']);