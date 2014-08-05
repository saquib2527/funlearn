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
		//if trying to resubmit / trigger post, bail out
		if( ! Session::has('test_start_time')){
			return Redirect::to('/categories');
		}

		//calculate time taken
		$test_end_time = (new DateTime())->format('U');
		$interval = $test_end_time - Session::get('test_start_time');

		//retrieve question ids and user answers
		$qids = Session::get('qids');
		$inputs = Input::except('_token');

		//form array where key is question id and value is user answer
		$answers = [];
		while($answer = current($inputs)){
			$qid = substr(key($inputs), 1);
			$answers[$qids[$qid]] = $answer;
			next($inputs);
		}

		//get question info
		$questions = DB::table('questions')
			->whereIn('id', $qids)
			->get();
		//retrieve correct answers
		$correct_answers = [];
		foreach($questions as $question){
			$correct_answers[$question->id] = $question->answer;
		}

		//find no. of correct and incorrect answers
		$num_correct_answer = 0;
		$num_incorrect_answer = 0;
		foreach($answers as $key=>$value){
			if($value == $correct_answers[$key]) $num_correct_answer++;
			else $num_incorrect_answer++;
		}
		$num_untouched = NUMBER_OF_QUESTIONS - ($num_correct_answer + $num_incorrect_answer);

		//points earned
		$points_earned = Helper::calculate_points_earned($num_correct_answer, $interval);

		//previous and current points and rank
		$previous_points = DB::table('users')->where('id', Auth::user()->id)->pluck('points');
		$previous_rank = Helper::rank_from_points($previous_points);
		$current_points = $previous_points + $points_earned;
		$current_rank = Helper::rank_from_points($current_points);

		//update points
		DB::table('users')->where('id', Auth::user()->id)->update(['points' => $current_points]);

		return View::make('result', [
			'active' => 'result',
			'num_correct_answer' => $num_correct_answer,
			'num_incorrect_answer' => $num_incorrect_answer,
			'num_untouched' => $num_untouched,
			'points_earned' => $points_earned,
			'previous_points' => $previous_points,
			'previous_rank' => $previous_rank,
			'current_points' => $current_points,
			'current_rank' => $current_rank,
			'answers' => $answers,
			'questions' => $questions
			]);
	}

}
