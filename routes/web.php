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

Route::get('/dashboard/create-city', 'App\Http\Controllers\CityController@create')->middleware(['auth'])->name('city.create');

Route::post('/dashboard/create-city', 'App\Http\Controllers\CityController@store')->middleware(['auth'])->name('city.store');

Route::get('/dashboard/import', 'App\Http\Controllers\ImportController')->middleware(['auth'])->name('import');

require __DIR__.'/auth.php';
