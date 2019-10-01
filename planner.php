<?php

include("data.php");

class Planner {

	static $duration = 30;
	static $breaks = 2;
	static $beginnerBreaks = 4;

	public static function planWorkout(array $participants,array $exercises): array {
	
		$expertIntervals = self::getIntervalLength($duration, $breaks);
		$beginnerIntervals = self::getIntervalLength($duration, $beginnerBreaks);

		// I'm going to create an array for each minute
		// so we can store all the data from the workout
		// for analytics or other future reference.
		$plannedMinutes = [];

		// let's start everyone off with a basic shared workout
		$bootcamp = self::createBootcamp($exercises);
		$plannedMinutes = self::assignExercisesToAll($bootcamp, $participants);


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
	just get a minute for each exercise with all doing the same
	*/
	public static function assignExercisesToAll($exerciseNames, $participants) {
		return array_map(function($exerciseName) use ($participants) {
			$minute = [];

			foreach ($participants as $person) {
				$minute[$person['name']] = $exerciseName;
			}

			return $minute;
		}, $exerciseNames);
	}

	/*
	create a plan interspersing cardio with non-cardio exercises
	without any limited or expert exercises
	without repeating any exercises
	so that everyone can participate
	*/
	public static function createBootcamp(array $exercises) {
		$basicExercises = array_filter($exercises, [self::class, "isBasic"]);
		$cardioExercises = array_filter($exercises, [self::class, "isCardio"]);
		$bootcamp = self::array_zip($cardioExercises, $basicExercises);

		return array_column($bootcamp, 'name');
	}

	private static function isBasic($exercise) {
		return 	self::canAllParticipate($exercise)
				&& empty($exercise['cardio']);
	}

	private static function isCardio($exercise) {
		return 	self::canAllParticipate($exercise)
				&& !empty($exercise['cardio']);
	}

	// get exercises with no special criteria
	private static function canAllParticipate($exercise) {
		return 	empty($exercise['limited_space'])
				&& empty($exercise['expert']);
	}

	/*
	Array zipper merge 
	taken from https://stackoverflow.com/questions/43618598/php-array-merge-in-alternate-order-zip-order
	*/
	public static function array_zip(...$arrays) {
	    return array_merge(...array_map(null, ...$arrays));
	}

	/*
	Choose an exercise for this user based on previous minutes
	*/
	private static function assignActivity(array $participant, array $exercises, array $pastMinutes): string
	{
		// get list of exercises not covered yet
		$history = self::getParticipantHistory($participant['name'], $pastMinutes);
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
}

?>