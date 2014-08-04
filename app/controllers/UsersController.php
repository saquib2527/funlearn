<?php

class UsersController extends BaseController{

	public function __construct()
	{
		$this->beforeFilter('auth', [
			'only' => ['getProfile', 'getLogout']
			]);

		$this->beforeFilter('guest', [
			'only' => ['getRegister', 'postRegister', 'getLogin', 'postLogin']
			]);
	}

	/**
	 * get registration
	 */
	public function getRegister()
	{
		return View::make('users.register', [
			'active' => 'register'
			]);
	}

	/**
	 * post registration
	 */
	public function postRegister()
	{
		$inputs = Input::only('fname', 'lname', 'email', 'password', 'password2');
		$v = Validator::make($inputs, User::$registrationRules, User::$registrationMessages);

		if($v->passes()){
			$user = new User;
			$user->fname = $inputs['fname'];
			$user->lname = $inputs['lname'];
			$user->email = $inputs['email'];
			$user->password = Hash::make($inputs['password']);
			$user->type = 'M';
			$user->save();

			Auth::loginUsingId($user->id);
			return Redirect::to('/')->with([
				'flashMessage' => 'Congrats, you are now logged in!',
				'alertClass' => 'alert-success'
				]);
		}
		return Redirect::to('users/register')->withInput()->withErrors($v);
	}

	/**
	 * get login
	 */
	public function getLogin()
	{
		return View::make('users.login', [
			'active' => 'login'
			]);
	}

	/**
	 * post login
	 */
	public function postLogin()
	{
		$inputs = Input::only('email', 'password');
		$v = Validator::make($inputs, User::$loginRules, User::$loginMessages);

		if($v->passes()){
			if(Auth::attempt($inputs)){
				return Redirect::intended('/');
			}
			return Redirect::to('users/login')->with([
				'flashMessage' => 'email / password does not match',
				'alertClass' => 'alert-danger'
				]);
		}
		return Redirect::to('users/login')->withInput()->withErrors($v);
	}

	/**
	 * get logout
	 */
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	/**
	 * get profile
	 */
	public function getProfile()
	{

	}

}
