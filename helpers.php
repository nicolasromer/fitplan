<?php 

static class Helpers {

	public static $introText = 'Today\'s participants are ';
  
	public static function introduce($participants) {

		$names = array_map(function($participant) {
			$status = " ({$participant['beginner']})" ?? ''
			return $participant['name'] . $status;
		}, $participants);

		return self::$introText . implode(', ',$names) . '.';
	}

}

?>