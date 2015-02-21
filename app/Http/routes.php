<?php

use App\User;
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

Route::get('home', 'HomeController@index');

Route::resource('users','UserController');
Route::resource('serviceadvisors','ServiceAdvisorController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/request-json-model', function(){
    //if 'User' is an eloquent model, this route should returns json response
    return User::all();
});