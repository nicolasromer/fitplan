<?php 

class Helpers {

	public static $introText = 'Today\'s participants are ';
  
	public static function introduce($participants) {

		if (empty($participants)) return 'No-one is working out today.';

		$names = array_map(function($participant) {
			$status = !empty($participant['beginner'])
			? ' (beginner)'
			: '';
			
			return $participant['name'] . $status;
		}, $participants);

		// todo: add 'and' before last name.

		return self::$introText . implode(', ',$names) . '.';
	}



	/*
	Array zipper merge 
	taken from https://stackoverflow.com/questions/43618598/php-array-merge-in-alternate-order-zip-order
	*/
	public static function array_zip(...$arrays) {
	    return array_merge(...array_map(null, ...$arrays));
	}

}

?>