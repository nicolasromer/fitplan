<?php

include("data.php");

class Planner {

	public static function planWorkout(
		array $participants,
		array $exercises,
		int $duration = 30,
		int $breaks = 2,
		int $beginnerBreaks = 4
	): array {
		
		// todo: proper validation
		if (!self::validateDurationAndBreaks($duration, $breaks, $beginnerBreaks)) {
			throw new Error('You need enough time to allow the number of breaks you want.');
		}

		// I'm going to create an array for each minute
		// so we can store all the data from the workout
		// for analytics or other future reference.
		$plannedMinutes = [];

		for ($i=0; $i < $duration; $i++) { 
		 	
			$minuteKey = 'Minute '. ($i+1);

			foreach ($participants as $participant) {
				
				$activity = self::assignActivity($participant, $exercises, $plannedMinutes);
				$plannedMinutes[$minuteKey][$participant['name']] = $activity;
			};
		 } 

		 return $plannedMinutes;
	}

	/*
	Choose an exercise for this user based on previous minutes
	*/
	private static function assignActivity(array $participant, array $exercises, array $pastMinutes): string
	{
		// get list of exercises not covered yet
		$history = self::getParticipantHistory($participant['name'], $pastMinutes, );
		$exerciseNames = array_column($exercises, 'name');
		$exercisesNotCovered = array_diff($exerciseNames, $history, ['rest']);
		$chosenExercise = empty($exercisesNotCovered)
			? $exercises[0]['name']
			: $exercisesNotCovered[0];

		// todo: logic for rests
		// todo: logic for high-demand equipment
		// todo: logic for cardio sports	

		return $chosenExercise;
	}

	/*
	Get this participant's exercises out of the overall plan
	*/
	public static function getParticipantHistory(string $name, array $pastMinutes)
	{
		return array_column($pastMinutes, $name);
	}

	private static function validateDurationAndBreaks(int $duration, int $breaks, int $beginnerBreaks): bool
	{
		// todo;
		return true;
	}

}

?>