<?php

class Helper{

	/**
	 * @desc performs set minus of second arg from first
	 * @param a Array
	 * @param b Array
	 * @return Array subset of a not in b
	 */
	public static function better_array_diff($a, $b)
	{
		$map = [];
		foreach($a as $val) $map[$val] = 1;
		foreach($b as $val){
			if(isset($map[$val])){
				unset($map[$val]);
			}
		}
		return array_keys($map);
	}

	/**
	 * @desc returns table name from category name
	 * @param category_name String name of category
	 * @return String table name
	 */
	public static function category_name_to_table_name($category_name)
	{
		$table_name = strtolower(str_replace(' ', '_', $category_name));
		$last_letter = $table_name[strlen($table_name) - 1];
		switch($last_letter){
			case 'y':
				$table_name = substr($table_name, 0, -1) . 'ies';
				break;
			case 's':
				break;
			default:
				$table_name = $table_name . 's';
		}
		return $table_name;
	}

	/**
	 * @desc returns table name from category id
	 * @param id Integer
	 * @return String table name
	 */
	public static function category_id_to_table_name($id)
	{
		$category_name = DB::table('categories')
						->where('id', $id)
						->pluck('name');
		return self::category_name_to_table_name($category_name);
	}

	/**
	 * @desc creates table from category name
	 * @param category_name String name of category
	 * @return Integer 0 if table already exists, 1 otherwise
	 */
	public static function create_table_from_category_name($category_name)
	{
		$table_name = self::category_name_to_table_name($category_name);
		if(Schema::hasTable($table_name)) return 0;
		Schema::create($table_name, function($table){
			$table->increments('id');
			$table->string('question');
			$table->char('opt1', 20);
			$table->char('opt2', 20);
			$table->char('opt3', 20);
			$table->char('opt4', 20);
			$table->tinyInteger('answer');
		});
		return 1;
	}

	/**
	 * returns rank from points
	 * @param points Integer points
	 * @return rank rank based on points
	 */
	public static function rank_from_points($points)
	{
		$rank_divider = 100;
		$rank = floor($points / $rank_divider);
		return $rank;
	}

}
