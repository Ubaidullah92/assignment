<?php

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
    return view('pages.index');
});

Route::get('/logout','Auth\LoginController@logout');
Auth::routes();
Route::get('student/all','studentController@getAllStudent');
Route::resource('student','studentController');
Route::get('send/student_details/{email}','HomeController@sendEmail');