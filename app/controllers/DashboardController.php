<?php

class DashboardController extends BaseController{

	public function __construct()
	{
		$this->beforeFilter('auth');
	}

	public function getIndex()
	{
		
	}

}
