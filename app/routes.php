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
	$ids = [];
	for($i = 1; $i <= 49961; $i+=5){
		$ids[] = $i;
	}
	$ids = json_encode($ids);
	DB::table('seen')
		->update([
		'user_id' => 2,
		'category_id' => 1,
		'qids' => $ids
		]);

	$start = microtime(true);
	$q = Helper::select_test_qids(2, 1);
	$questions = DB::table('questions')
		->whereIn('id', $q)
		->get();
	var_dump($questions);
	$end = microtime(true);
	echo "<br>time taken: " . ($end - $start) . " seconds<br>";
});

Route::controller('dashboard', 'DashboardController');
Route::controller('users', 'UsersController');
Route::controller('categories', 'CategoriesController');
Route::controller('tests', 'TestsController');
