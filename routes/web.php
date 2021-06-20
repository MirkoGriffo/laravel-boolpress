<?php

use Illuminate\Support\Facades\Auth;
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

//route for authentication

Auth::routes();

//ROUTE AREA ADMIN

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        //route home admin
        Route::get('/', 'HomeController@index')->name('home');

        //route reource posts
        Route::resource('/posts', 'PostController');
    });

//Frontend
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
