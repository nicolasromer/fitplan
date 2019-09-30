<?php 

class Helpers {

	public static $introText = 'Today\'s participants are ';
  
	public static function introduce($participants) {

		$names = array_map(function($participant) {
			$status = !empty($participant['beginner'])
			? ' (beginner)'
			: '';
			
			return $participant['name'] . $status;
		}, $participants);

		return self::$introText . implode(', ',$names) . '.';
	}

}

?>