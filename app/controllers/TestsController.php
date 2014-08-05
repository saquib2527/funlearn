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
		//guests should be redirected to login page
		if(Auth::guest()){
			Session::put('url.intended', 'categories/');
			return Redirect::to('users/login');
		}

		//admins cant give tests
		if(Auth::check() && Auth::user()->type == 'A'){
			return Redirect::to('/')->with([
				'flashMessage' => 'admins cannot attend tests',
				'alertClass' => 'alert-danger'
				]);
		}

		//if session does not have this data, user tried to bypass topic selection
		if( ! (Session::has('test_category_id') && Session::has('test_category_name'))){
			return Redirect::to('categories');
		}

		$qids = Helper::select_test_qids(Auth::user()->id, Session::get('test_category_id'));
		sort($qids);
		$questions = DB::table('questions')
						->whereIn('id', $qids)
						->get(['question', 'opt1', 'opt2', 'opt3', 'opt4']);
		Session::flash('qids', $qids);
		Session::flash('test_start_time', (new DateTime())->format('U'));

		return View::make('attend', [
			'active' => 'test',
			'questions' => $questions
			]);
	}

	public function postAttend()
	{
		$test_end_time = (new DateTime())->format('U');
		$interval = $test_end_time - Session::get('test_start_time');
		return $interval;
		$qids = Session::get('qids');
		$answers = Input::except('_token');

	}

}
