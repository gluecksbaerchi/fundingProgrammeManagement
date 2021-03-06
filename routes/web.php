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

Route::get('funding_programmes', 'FundingProgrammesController@show')->middleware(['auth', 'permission:view-funding-programmes']);
Route::get('funding_programmes/{fundingProgramme}', 'FundingProgrammesController@detail')->middleware(['auth', 'permission:view-funding-programmes']);
Route::get('funding_programmes/{id}/edit', 'FundingProgrammesController@edit')->middleware(['auth', 'permission:create-funding-programmes']);
Route::post('funding_programmes/{id}/edit', 'FundingProgrammesController@save')->middleware(['auth', 'permission:create-funding-programmes']);
Route::get('funding_programmes/{fundingProgramme}/delete', 'FundingProgrammesController@delete')->middleware(['auth', 'permission:delete-funding-programmes']);
Route::post('funding_programmes/filter', 'FundingProgrammesController@filter')->middleware(['auth', 'permission:view-funding-programmes']);

Route::get('contacts', 'ContactsController@show')->middleware(['auth', 'permission:view-funding-programmes']);
Route::get('contacts/{fundingProgramme}', 'ContactsController@detail')->middleware(['auth', 'permission:view-funding-programmes']);
Route::get('contacts/{id}/edit', 'ContactsController@edit')->middleware(['auth', 'permission:create-funding-programmes']);
Route::post('contacts/{id}/edit', 'ContactsController@save')->middleware(['auth', 'permission:create-funding-programmes']);
Route::get('contacts/{contact}/delete', 'ContactsController@delete')->middleware(['auth', 'permission:delete-funding-programmes']);

Route::get('contacts', 'ContactsController@show')->middleware(['auth', 'permission:view-funding-programmes']);
Route::get('contacts/{id}/edit', 'ContactsController@edit')->middleware(['auth', 'permission:create-funding-programmes']);
Route::post('contacts/{id}/edit', 'ContactsController@save')->middleware(['auth', 'permission:create-funding-programmes']);
Route::get('contacts/{contact}/delete', 'ContactsController@delete')->middleware(['auth', 'permission:delete-funding-programmes']);

Route::get('categories', 'CategoriesController@show')->middleware(['auth', 'permission:view-categories']);
Route::get('categories/{id}/edit', 'CategoriesController@edit')->middleware(['auth', 'permission:create-categories']);
Route::post('categories/{id}/edit', 'CategoriesController@save')->middleware(['auth', 'permission:create-categories']);
Route::get('categories/{category}/delete', 'CategoriesController@delete')->middleware(['auth', 'permission:delete-categories']);

Route::get('profile', 'UsersController@profile')->middleware(['auth', 'permission:edit-profile']);
Route::post('profile', 'UsersController@saveProfile')->middleware(['auth', 'permission:edit-profile']);

Route::group(['middleware' => ['auth', 'role:admin', 'permission:user-management']], function() {
    Route::get('users', 'UsersController@show');
    Route::get('users/{id}/edit', 'UsersController@edit');
    Route::post('users/{id}/edit', 'UsersController@save');
    Route::get('users/{user}/delete', 'UsersController@delete');
});