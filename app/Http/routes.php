<?php

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

Route::get('/', function () {
    return view('welcome');
});

/* DEVELOPMENT ROUTES */
// Testing stuff, delete when done
Route::get('character', 'CharacterController@testCharacter');


/* LOGIN / LOGOUT / REGISTRATION ROUTES  */

// Authentication routes
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

/* USER RELATED ROUTES */
Route::group(['middleware' => 'auth'], function () {
    // View Dashboard
    Route::get('dashboard', 'UserController@dashboard');

    // Update character details
    Route::post('dashboard/character', 'UserController@updateCharacter');
});


/* GROUP RELATED ROUTES */
// TODO: Put this behind entrust
Route::group(['middleware' => 'auth'], function () {
    Route::post('group/create', 'GroupController@store');
    Route::post('group/addtogroup', 'GroupController@addUserToGroup');
});

/* FORUM ADMINISTRATION RELATED ROUTES */
// TODO: Put this behind entrust
Route::group(['middleware' => 'auth'], function () {
    Route::post('forum/create', 'ForumController@store');
    Route::post('forum/update/{id}', 'ForumController@update');
});
