<?php

include("data.php");

class Planner {

	public function planWorkout(
		array $participants,
		array $exercises,
		int $duration = 30,
		int $breaks = 2,
		int $beginnerBreaks = 4
	): void {
		
		// todo: validate duration against number of breaks.
		if (!self::validateDurationAndBreaks($duration, $breaks, $beginnerBreaks)) {
			throw new Error('You need enough time to allow the number of breaks you want.');
		}

		// I'm going to create an array for each minute
		// so we can store all the data from the workout
		// for analytics or other future reference.
		$plannedMinutes = [];

		for ($i=0; $i < $duration; $i++) { 
		 	
		 	// map over the participants
			$plan = array_map(function($participant) {
				
				self::assignExercise($participant, $plannedMinutes);

			}, $participants);

		 } 

	}

	/*
	Choose an exercise for this user based on previous minutes
	*/
	private static function assignExercise(array $participant, array $pastMinutes): string 
	{

	}

	/*
	Get this participant's exercises
	*/
	private static function getParticipantHistory(array $participant, array $pastMinutes)
	{

	}

	private static function validateDurationAndBreaks(int $duration, int $breaks, int $beginnerBreaks): boolean
	{
		// todo;
		return true;
	}

}

?>