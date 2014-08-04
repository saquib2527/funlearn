<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home', [
		'active' => 'home'
		]);
});

Route::get('exp', function()
{
	return Helper::select_test_qids(2, 1);
});

Route::controller('dashboard', 'DashboardController');
Route::controller('users', 'UsersController');
Route::controller('categories', 'CategoriesController');
Route::controller('tests', 'TestsController');
