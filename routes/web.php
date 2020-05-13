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
Route::get('login', 'Web\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Web\Auth\LoginController@login');
Route::post('logout', 'Web\Auth\LoginController@logout')->name('logout');
Route::get('register', 'Web\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Web\Auth\RegisterController@register');

Route::get('/', '\App\Http\Controllers\Web\Task\MyListController')->name('home');
Route::post('/task', '\App\Http\Controllers\Web\Task\PostController')->name('task.store');

Route::get('/list/new', '\App\Http\Controllers\Web\Task\ListController@new')->name('list.new');
Route::post('/list', '\App\Http\Controllers\Web\Task\ListController@store')->name('list.store');
Route::get('/list/{listId}/edit', '\App\Http\Controllers\Web\Task\ListController@edit')->name('list.edit');
Route::put('/list/{listId}', '\App\Http\Controllers\Web\Task\ListController@update')->name('list.update');

Route::get('/list/{listId}/task/{taskId}/change/{state}', '\App\Http\Controllers\Web\Task\ChangeStateController')->name('task.change.state')->where('state', 'complete|rollback-complete');

