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

//Route all connections to / through a redirect function taking them to the home Route
Route::get('/', function () {return redirect()->route('home');});

//Return the the url extension list with the content created by the EventController@list command, and name this route list to allow easier calling.
Route::get('list', 'EventController@list')->name('list');

//Return the url extension show/{ID} with the content created by the EventController@show command, and name this route show to allow easier calling. The ID value is called from the request passed with the Route call.
Route::get('show/{id}', 'EventController@show')->name('show');

//Return the the url extension UserList with the content created by the UserController@list command, and name this route userlist to allow easier calling.
Route::get('UserList','UserController@list')->name('userlist');

//Return the the url extension UserProfile/{ID} with the content created by the UserController@profile command, and name this route userprofile to allow easier calling. The ID value is called from the request passed with the Route call.
Route::get('Userprofile/{id}','UserController@profile')->name('userprofile');

//Return the the url extension Userevents with the content created by the UserController@myevents command, and name this route userevents to allow easier calling.
Route::get('Userevents','EventController@myevents')->name('userevents');

//Return the url extension showcategory/{category} with the content created by the EventController@showbytype command, and name this route category to allow easier calling. The category value is called from the enum value passed with the Route call.
Route::get('showcategory/{category}', 'EventController@showbytype')->name('category');

//Return the the url extension home with the content created by the HomeController@index command, and name this route home to allow easier calling.
Route::get('/home', 'HomeController@index')->name('home');

//This sets up the routes for the login and authentication pages login and register
Auth::routes();

// Take the inputted extension eventsort and pass it and the request to the EventController@sort. The route is named eventsort for easier calling.
Route::post('eventsort','EventController@sort')->name('eventsort');

// Take the inputted extension usersort and pass it and the request to the UserController@sort. The route is named usersort for easier calling.
Route::post('usersort','UserController@sort')->name('usersort');

// Take the inputted extension like/{ID} and pass it and the request to the EventController@like. The route is named likevent for easier calling and the ID value is pulled from the request.
Route::post('like/{id}', 'EventController@like')->name('likeevent');

// Take the inputted extension unlike/{ID} and pass it and the request to the EventController@unlike. The route is named unlikevent for easier calling and the ID value is pulled from the request.
Route::post('unlike/{id}', 'EventController@unlike')->name('unlikeevent');

//Check if the User making the request is an authorised user. If they arent then reroute to the login screen. If they are return the the url extension updateevent{ID} with the content created by the EventController@alterevent command, and name this alterevent to allow easier calling.
Route::middleware('auth')->get('updateevent/{id}', 'EventController@alterevent')->name('alterevent');

//Check if the User making the request is an authorised user. If they arent then reroute to the login screen. If they are return the the url extension createevent with the content created by the EventController@createevent command, and name this createevent to allow easier calling.
Route::middleware('auth')->get('createevent','EventController@createevent')->name('createevent');

//Check if the User making the request is an authorised user. If they arent then reroute to the login screen. If they are take the inputted extension updateevent/{id} and pass it and the request to the EventController@updateevent. The route is named updateevent for easier calling and the ID value is pulled from the request.
Route::middleware('auth')->post('updateevent/{id}' , 'EventController@updateevent')->name('updateevent');

//Check if the User making the request is an authorised user. If they arent then reroute to the login screen. If they are take the inputted extension deleteevent/{id} and pass it and the request to the EventController@deleteevent. The route is named deleteevent for easier calling and the ID value is pulled from the request.
Route::middleware('auth')->post('deleteevent/{id}' , 'EventController@deleteevent')->name('deleteevent');

//Check if the User making the request is an authorised user. If they arent then reroute to the login screen. If they are take the inputted extension createevent/{id} and pass it and the request to the EventController@create. The route is named create.event for easier calling.
Route::middleware('auth')->post('createevent','EventController@create')->name('create.event');

