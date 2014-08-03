<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Timestamp column.
	 */
	public $timestamps = false;

	/**
	 * Form validation rules for registration.
	 */
	public static $registrationRules = [
		'fname' => 'required',
		'lname' => 'required',
		'email' => 'email|required|unique:users,email',
		'password' => 'required|min:6',
		'password2' => 'required|same:password'
		];

	/**
	 * Form validation rules for logging in.
	 */
	public static $loginRules = [
		'email' => 'required',
		'password' => 'required'
		];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
