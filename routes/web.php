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

Route::get('/dashboard', 'App\Http\Controllers\DashboardController')->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/create-city', 'App\Http\Controllers\CityController@create')->middleware(['auth', 'admin'])->name('city.create');

Route::post('/dashboard/create-city', 'App\Http\Controllers\CityController@store')->middleware(['auth', 'admin'])->name('city.store');

Route::get('/dashboard/import', 'App\Http\Controllers\ImportController')->middleware(['auth', 'admin'])->name('import');

Route::get('/dashboard/add-comment', 'App\Http\Controllers\CommentController@create')->name('comment.create');

Route::post('/dashboard/add-comment', 'App\Http\Controllers\CommentController@store')->name('comment.store');

Route::get('/dashboard/edit-comment/{comment}', 'App\Http\Controllers\CommentController@edit')->name('comment.edit');

Route::patch('/dashboard/update-comment/{comment}', 'App\Http\Controllers\CommentController@update')->name('comment.update');

Route::delete('/dashboard/delete-comment/{comment}', 'App\Http\Controllers\CommentController@destroy')->name('comment.delete');

require __DIR__.'/auth.php';
