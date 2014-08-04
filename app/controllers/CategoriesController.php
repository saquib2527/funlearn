<?php

class CategoriesController extends BaseController{

	public function __construct()
	{
		$this->beforeFilter('admin', [
			'only' => ['getAdd', 'postAdd']
			]);
	}

	public function getIndex()
	{
		$categories = Category::all();
		return View::make('browse', [
			'active' => 'browse',
			'categories' => $categories
			]);
	}

}
