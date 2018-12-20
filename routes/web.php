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
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
})->name('main');

Route::get('/hello', function(){
  return view('hello');
})->middleware("auth");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(["prefix"=>"admin","middleware"=>["auth","language"]] , function(){

    $locale = Session::get('locale');
    \App::setLocale($locale);

    Route::get('/', function(){
       return view("admin.index");
    })->name('admin.main');

    Route::resource('department','DepartmentController');
    Route::resource('employee','EmployeeController');
    Route::resource('room','RoomController');
    Route::resource('campus','CampusController');
    Route::resource('equipment','EquipmentController');
    Route::resource('act','ActController');
    Route::resource('task' , 'TaskController');

    Route::get('equipment/{id}/assign' , 'EquipmentController@assign_form')->name('equipment.assign');
    Route::post('equipment/{id}/assign' , 'EquipmentController@assign')->name('equipment.assign_update');
    Route::get('image/delete/{id}' , 'RoomImageController@destroy')->name('image.delete');

    Route::get('equipment/get-feature-fields/{id}' , 'EquipmentController@getFeatureFields');

    Route::get('reports/' , 'ReportController@index')->name('reports.index');
    Route::get('reports/download' , 'ReportController@download')->name('reports.download');

    Route::get('lang/az' , function(){
        Session::put('locale','az');
        return back();
    })->name('lang.az');

    Route::get('lang/en' , function(){
        Session::put('locale' , 'en');
        return back();
    })->name('lang.en');

    Route::get('test' , function(){
       $locale = Session::get('locale');
       \App::setLocale($locale);
       return __('content.hello');
    });

});
