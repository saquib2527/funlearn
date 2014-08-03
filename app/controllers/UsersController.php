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

	}

	/**
	 * post login
	 */
	public function postLogin()
	{

	}

	/**
	 * get logout
	 */
	public function getLogout()
	{

	}

	/**
	 * get profile
	 */
	public function getProfile()
	{

	}

}
