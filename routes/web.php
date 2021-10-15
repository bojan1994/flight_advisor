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

Route::get('/dashboard/add-comment', 'App\Http\Controllers\CommentController@create')->middleware(['auth', 'regular'])->name('comment.create');

Route::post('/dashboard/add-comment', 'App\Http\Controllers\CommentController@store')->middleware(['auth', 'regular'])->name('comment.store');

Route::get('/dashboard/edit-comment/{comment}', 'App\Http\Controllers\CommentController@edit')->middleware(['auth', 'regular'])->name('comment.edit');

Route::patch('/dashboard/update-comment/{comment}', 'App\Http\Controllers\CommentController@update')->middleware(['auth', 'regular'])->name('comment.update');

Route::delete('/dashboard/delete-comment/{comment}', 'App\Http\Controllers\CommentController@destroy')->middleware(['auth', 'regular'])->name('comment.delete');

Route::post('/dashboard/number-of-comments/{cityId}/{limit}', 'App\Http\Controllers\NumberOfCommentsController')->middleware(['auth', 'regular'])->name('comments.number');

Route::post('/dashboard/search-by-city/{cityName}', 'App\Http\Controllers\SearchByCityController')->middleware(['auth', 'regular'])->name('city.search');

Route::get('/dashboard/find-flight', 'App\Http\Controllers\FlightController@index')->middleware(['auth', 'regular'])->name('flight.index');

Route::post('/dashboard/find-flight/{fromCityName}/{toCityName}', 'App\Http\Controllers\FlightController@getFlights')->middleware(['auth', 'regular'])->name('flight.find');

require __DIR__.'/auth.php';
