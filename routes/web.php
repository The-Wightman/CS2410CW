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
    return redirect()->route('home');
});




Route::get('list', 'EventController@list')->name('list');

Route::get('show/{id}', 'EventController@show')->name('show');

Route::get('display','EventController@display')->name('display_event');

Route::get('UserList','UserController@list')->name('userlist');

Route::get('Userprofile/{id}','UserController@profile')->name('userprofile');

Route::get('Userevents','EventController@myevents')->name('userevents');

Route::get('showcategory/{category}', 'EventController@showbytype')->name('category');

Auth::routes();

Route::post('eventsort','EventController@sort')->name('eventsort');

Route::post('usersort','UserController@sort')->name('usersort');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->get('updateevent/{id}', 'EventController@alterevent')->name('alterevent');

Route::middleware('auth')->post('updateevent/{id}' , 'EventController@updateevent')->name('updateevent');

Route::middleware('auth')->post('deleteevent/{id}' , 'EventController@deleteevent')->name('deleteevent');

Route::get('createevent','EventController@createevent')->name('createevent');

Route::middleware('auth')->post('createevent','EventController@create')->name('create.event');

Route::post('like/{id}', 'EventController@like')->name('likeevent');

Route::post('unlike/{id}', 'EventController@unlike')->name('unlikeevent');
