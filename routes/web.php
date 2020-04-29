<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UseraccessController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Super Admin
Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
    //User
    Route::get('/user', 'UserController@index');
    Route::get('/user/{id}/edit', 'UserController@edit');
    Route::post('/user/{id}/update', 'UserController@update');
    Route::delete('/user/{id}', 'UserController@destroy');

    //Role
    Route::get('/role', 'RoleController@index');
    Route::get('/role/{role}/edit', 'RoleController@edit')->name('editaccess');
    Route::get('/role/{id}/deactivated', 'RoleController@deactivated');
    Route::get('/role/{id}/activated', 'RoleController@activated');

    //User Access
    Route::post('/role/store', 'UseraccessController@store')->name('storeaccess');
    Route::delete('/role/{id}', 'UseraccessController@destroy')->name('menudelete');

    //Menu
    Route::get('/menu', 'MenuController@index');
    Route::post('/menu', 'MenuController@store');
    Route::get('/menu/{id}/edit', 'MenuController@show');
    Route::get('/menu/{id}/activated', 'MenuController@activated');
    Route::get('/menu/{id}/deactivated', 'MenuController@deactivated');

    //Submenu
    Route::get('/submenu/{id}/activated', 'SubmenuController@activated');
    Route::get('/submenu/{id}/deactivated', 'SubmenuController@deactivated');
    // Route::resource('submenu', 'SubmenuController');
});

//School Admin
Route::group(['middleware' => ['auth', 'CheckRole:1,5']], function () {
});

//Public
Route::get('/dashboard', 'HomeController@index');
Route::get('/school', 'SchoolController@index')->name('schoolreg');
Route::post('school', 'SchoolController@store');
Route::get('/profile/{id}', 'HomeController@profile');

//Import from Excel file
Route::post('import/import_data', 'ImportExcelController@import')->name('startImport');
Route::get('import/clear_data', 'ImportExcelController@clear')->name('cleardata');
Route::get('/saveto_table', 'TeacherController@saveto_table')->name('TeacherSave');


//Teachers
Route::get('/staff', 'TeacherController@index');
Route::get('/teacher/create', 'TeacherController@create')->name('new_teacher');
Route::post('/teacher', 'TeacherController@store')->name('teacher');
Route::get('/teacher/import', 'ImportExcelController@index')->name('importExcel');
Route::get('/teacher/{id}', 'TeacherController@show');
Route::put('/teacher/{id}', 'TeacherController@update');

//Students
Route::resource('student', 'StudentController');
Route::get('/student/import', 'ImportExcelController@index');
Route::get('/student/save', 'StudentController@saveto_table')->name('StudentSave');

//Subject
Route::resource('subject', 'SubjectController');
Route::post('/subject/teacher', 'SubjectController@subjectteacher');

//Classroom
// Route::get('/classroom', 'ClassroomController@index');
// Route::post('/classroom', 'ClassroomController@store');
// Route::get('/classroom/{classroom}', 'ClassroomController@show');
// Route::get('/classroom/{classroom}/edit', 'ClassroomController@edit');
// Route::put('/classroom/{classroom}', 'ClassroomController@update');
Route::resource('classroom', 'ClassroomController');
Route::post('/classroom/addschedule', 'ClassroomController@addSchedule');

//mail
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');
