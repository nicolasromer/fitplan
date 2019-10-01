<?php 

class Helpers {

	public static $introText = 'Today\'s participants are ';
	public static $noWorkoutText = 'No-one is working out today.';
  
	public static function introduce($participants) {

		if (empty($participants)) return self::$noWorkoutText;

		$names = array_map(function($participant) {
			$status = !empty($participant['beginner'])
			? ' (beginner)'
			: '';
			
			return $participant['name'] . $status;
		}, $participants);

		// todo: add 'and' before last name.

		return self::$introText . implode(', ',$names) . '.';
	}

}

?>