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

	}

	/**
	 * post registration
	 */
	public function postRegister()
	{

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
		$v = Validator::make($inputs, User::$loginRules);

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
