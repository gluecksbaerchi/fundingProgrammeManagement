<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('funding_programmes');
});

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@doLogin');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('funding_programmes', 'FundingProgrammesController@show')->middleware('auth');
Route::get('categories', 'CategoriesController@show')->middleware('auth');

Route::group(['middleware' => ['auth', 'role:admin', 'permission:user-management']], function() {
    Route::get('users', 'UsersController@show');
    Route::get('users/{id}/edit', 'UsersController@edit');
    Route::post('users/{id}/edit', 'UsersController@save');
    Route::get('users/{user}/delete', 'UsersController@delete');
});