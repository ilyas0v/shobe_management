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
    return view('welcome');
})->name('main');

Route::get('/hello', function(){
  return view('hello');
})->middleware("auth");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(["prefix"=>"admin","middleware"=>"auth"] , function(){
    Route::get('/', function(){
       return view("admin.index");
    })->name('admin.main');

    Route::resource('department','DepartmentController');
    Route::resource('employee','EmployeeController');
    Route::resource('room','RoomController');
    Route::resource('campus','CampusController');
});
