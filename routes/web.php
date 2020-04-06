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

Route::get('/', function () {
    return view('guest');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->middleware('auth');
Route::get('/staff', 'HomeController@staff');
Route::get('/school', 'SchoolController@index');
Route::get('/menu', 'MenuController@getSubMenu');
Route::post('/school', 'SchoolController@store');
