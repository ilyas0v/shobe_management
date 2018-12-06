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
    Route::resource('equipment','EquipmentController');
    Route::resource('act','ActController');
    Route::get('equipment/{id}/assign' , 'EquipmentController@assign_form')->name('equipment.assign');
    Route::post('equipment/{id}/assign' , 'EquipmentController@assign')->name('equipment.assign_update');
    Route::get('image/delete/{id}' , 'RoomImageController@destroy')->name('image.delete');
});
