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
	 * Returns array of ids of given category
	 *
	 * @param $category_id integer id of category
	 * @return array
	 */
	public static function get_category_qids($category_id)
	{
		$qids = DB::table('questions')
			->where('category_id', $category_id)
			->lists('id');
		return $qids;
	}

	/**
	 * Returns array of ids of seen questions of given category
	 *
	 * @param $user_id integer id of user
	 * @param $category_id integer id of category
	 */
	public static function get_seen_qids($user_id, $category_id)
	{
		$seen_qids = DB::table('seen')
			->where([
			'user_id' => $user_id,
			'category_id' => $category_id
			])
			->pluck('qids');
		if($seen_qids !== NULL){
			$seen_qids = json_decode($seen_qids);
		}else{
			$seen_qids = ['0'];
		}
		return $seen_qids;
	}

	/**
	 * Adds question ids to seen questions
	 */
	public static function add_to_seen_questions($qids, $user_id, $category_id)
	{
		$seen = DB::table('seen')
			->where(['user_id' => $user_id, 'category_id' => $category_id])
			->pluck('qids');
		if(empty($seen)){
			$qids = json_encode($qids);
			DB::table('seen')->insert([
				'user_id' => Auth::user()->id,
					'category_id' => $category_id,
					'qids' => $qids
					]);
		}else{
			$seen = json_decode($seen);
			$qids = json_encode(array_merge($seen, $qids));
			DB::table('seen')
				->where(['user_id' => $user_id, 'category_id' => $category_id])
				->update(['qids' => $qids]);
		}
	}

	/**
	 * Selects question ids for test
	 */
	public static function select_test_qids($user_id, $category_id)
	{
		$category_qids = self::get_category_qids($category_id);
		$seen_qids = self::get_seen_qids($user_id, $category_id);
		$eligible_qids = self::better_array_diff($category_qids, $seen_qids);

		$num = count($eligible_qids);

		//there are not sufficient unseen questions
		if($num < NUMBER_OF_QUESTIONS){
			$second_eligible_qids = self::better_array_diff($category_qids, $eligible_qids);
			$random_keys = array_rand($second_eligible_qids, NUMBER_OF_QUESTIONS - $num);
			$final_qids = [];
			if(is_array($random_keys)){
				foreach($random_keys as $key){
					$final_qids[] = $second_eligible_qids[$key];
				}
			}else{
				$final_qids[] = $random_keys;
			}
			//merge the tow
			$final_qids = array_merge($final_qids, $eligible_qids);
			//reset value
			$reset_value = [0];
			$reset_value = json_encode($reset_value);
			DB::table('seen')
				->update([
				'user_id' => $user_id,
				'category_id' => $category_id,
				'qids' => $reset_value
				]);
		}else{//there are sufficient questions
			$random_keys = array_rand($eligible_qids, NUMBER_OF_QUESTIONS);
			$final_qids = [];
			foreach($random_keys as $key){
				$final_qids[] = $eligible_qids[$key];
			}
		}

		self::add_to_seen_questions($final_qids, $user_id, $category_id);

		return $final_qids;
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
