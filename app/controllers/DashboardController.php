<?php

class DashboardController extends BaseController{

	public function __construct()
	{
		$this->beforeFilter('admin');
	}

	public function getIndex()
	{
		
	}

}
