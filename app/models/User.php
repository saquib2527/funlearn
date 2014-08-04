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
	 * Error messages for registration panel.
	 */
	public static $registrationMessages = [
		'fname.required' => 'Your first name is required.',
		'lname.required' => 'Your last name is required.',
		'email.email' => 'You need to provide a valid email address.',
		'email.required' => 'Your email address is required.',
		'email.unique' => 'User with this email address is already registered.',
		'password.required' => 'You need to provide a password.',
		'password.min' => 'Password should be at least 6 characters.',
		'password2.required' => 'You need to retype your password.',
		'password2.same' => 'Password does not match.'
		];

	/**
	 * Form validation rules for logging in.
	 */
	public static $loginRules = [
		'email' => 'required',
		'password' => 'required'
		];

	/**
	 * Error messages for login panel.
	 */
	public static $loginMessages = [
		'email.required' => 'Please enter your email address.',
		'password.required' => 'Please enter your password.'
		];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
