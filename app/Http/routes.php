<?php

use App\User;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    return View::make('singlepage');
});

Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/expiry', function(){
    Return response()->json(array('flash' => 'all is good!'));
    //Return response()->json(array('flash' => 'Your session has expired!'),401);
});
Route::get('home', 'HomeController@index');

Route::get('getUsers', 'UserController@getUsers');
Route::resource('users','UserController');

Route::get('getExtensions', 'ExtensionController@getExtensions');
Route::resource('extensions','ExtensionController');

Route::resource('serviceadvisors','ServiceAdvisorController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/request-json-model', function(){
    //if 'User' is an eloquent model, this route should returns json response
    return User::all();
});