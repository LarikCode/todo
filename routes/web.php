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

Route::get('/todos', 'TodoController@index')->name('todo.index');

Route::get('/todos/create', 'TodoController@create');

Route::get('/todos/{todo}/edit', 'TodoController@edit');

Route::patch('/todos/{todo}/edit', 'TodoController@update')->name('todo.update');

Route::put('/todos/{todo}/complete', 'TodoController@complete')->name('todo.complete');

Route::post('/todos/create', 'TodoController@store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
