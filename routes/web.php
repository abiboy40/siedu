<?php

use App\Http\Controllers\UseraccessController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest');
});

Auth::routes();

//Super Admin
Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
    Route::get('/role', 'RoleController@index');
    Route::get('{role}/edit', 'RoleController@edit')->name('editaccess');
    Route::get('/Changeaccess', 'RoleController@changeaccess');
    Route::post('/role/store', 'UseraccessController@store')->name('storeaccess');
    Route::delete('/role/{id}', 'UseraccessController@destroy')->name('menudelete');
});

//School Admin
Route::group(['middleware' => ['auth', 'CheckRole:1,5']], function () {
    Route::get('/menu', 'MenuController@getSubMenu');
});

//Public
Route::get('/dashboard', 'HomeController@index');
Route::get('/school', 'SchoolController@index')->name('schoolreg');
Route::post('school', 'SchoolController@store');
Route::get('/profile/{id}', 'HomeController@profile');

//Import from Excel file
Route::get('/import', 'ImportExcelController@index')->name('importExcel');
Route::post('import/import_data', 'ImportExcelController@import')->name('startImport');
Route::get('import/clear_data', 'ImportExcelController@clear')->name('cleardata');
Route::get('/saveto_table', 'TeacherController@saveto_table')->name('TeacherSave');


//Teachers
Route::get('/staff', 'HomeController@staff');
Route::get('/teacher/{id}', 'TeacherController@show');
Route::get('/teacher/create', 'TeacherController@create')->name('new_teacher');
Route::post('/teacher', 'TeacherController@store')->name('teacher');

//Students
Route::get('/student/{id}', 'StudentController@profile');
