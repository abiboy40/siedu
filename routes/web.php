<?php

use App\Http\Controllers\UseraccessController;
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
Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
    Route::get('/role', 'RoleController@index');
    Route::get('{role}/edit', 'RoleController@edit')->name('editaccess');
    Route::get('/Changeaccess', 'RoleController@changeaccess');
    Route::post('/role/store', 'UseraccessController@store')->name('storeaccess');
    Route::delete('/role/{id}', 'UseraccessController@destroy')->name('menudelete');
});

Route::group(['middleware' => ['auth', 'CheckRole:1,5']], function () {
    Route::get('/staff', 'HomeController@staff');
    Route::get('/menu', 'MenuController@getSubMenu');
});

Route::get('/school', 'SchoolController@index')->name('schoolreg');
Route::post('/school', 'SchoolController@store');
Route::get('/dashboard', 'HomeController@index');
Route::get('/profile/{id}', 'HomeController@profile');
Route::get('/teacher/{id}', 'TeacherController@profile');
Route::get('/student/{id}', 'StudentController@profile');
