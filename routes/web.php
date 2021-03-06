<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::resource('todoList.todos', TodoController::class);
    Route::put('/todos/{todo}/complete', 'TodoController@complete')->name('todos.complete');
    Route::put('/{todoList}/todos/{todo}/up', 'TodoController@up')->name('todos.up');
    Route::put('/{todoList}/todos/{todo}/down', 'TodoController@down')->name('todos.down');

    Route::resource('/todolist', 'TodoListController');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
