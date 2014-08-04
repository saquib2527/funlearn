<?php

class TestsController extends BaseController{

	public function __construct()
	{

	}

	public function getView($category_name = NULL)
	{
		if(Auth::guest()){
			Session::put('url.intended', 'tests/view/' . $category_name);
			return Redirect::to('users/login');
		}

		$category_name = strtolower(str_replace('-', ' ', $category_name));
		$category = Category::where('name', $category_name)->firstOrFail();
		Session::flash('test_category_id', $category->id);
		Session::flash('test_category_name', $category->name);
		return View::make('category', [
			'active' => 'browse',
			'category' => $category
			]);
	}

	public function getAttend()
	{
		if(Auth::guest()){
			Session::put('url.intended', 'categories/');
			return Redirect::to('users/login');
		}

		if(Auth::check() && Auth::user()->type == 'A'){
			return Redirect::to('/')->with([
				'flashMessage' => 'admins cannot attend tests',
				'alertClass' => 'alert-danger'
				]);
		}
		
		if( ! (Session::has('test_category_id') && Session::has('test_category_name'))){
			return Redirect::to('categories');
		}
	}

}
