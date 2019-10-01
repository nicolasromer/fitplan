<?php

class Planner {

	static $duration = 30;
	static $breaks = 2;
	static $beginnerBreaks = 4;

	public static function planWorkout(array $participants,array $exercises): array {
		// I'm going to create an array for each minute
		// so we can store all the data from the workout
		// for analytics or other future reference.
		$plannedMinutes = [];

		// let's start everyone off with a basic shared workout
		$bootcampExercises = self::createBootcamp($exercises);
		$plannedMinutes = self::assignExercisesToAll($bootcampExercises, $participants);

		// let's do the handstand round
		$plannedMinutes[] = self::assignExercisesToAll(['handstand'], $participants)[0];

		// the rest of the workout rotates people on and off the limited gear
		$currentMinute = count($plannedMinutes);
		
		

		return $plannedMinutes;
	}


	/*
	just get a minute for each exercise with all doing the same.
	This is how we start all the workouts.
	*/
	public static function assignExercisesToAll($exerciseNames, $participants) {
		return array_map(function($index, $exerciseName) use ($participants) {
			$minute = [];

			foreach ($participants as $person) {
				// todo: allow us to pass in current index
				$currentMinute = $index + 1;
				$shouldRest = self::shouldRest($index + 1, $person);

				$minute[] = [
					'participant' => $person['name'],
					'activity' => $shouldRest ? 'rest' : $exerciseName,
				];
			}

			return $minute;
		}, array_keys($exerciseNames), $exerciseNames);
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
		$bootcamp = Helpers::array_zip($cardioExercises, $basicExercises);

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
	how long should we workout before taking a break?
	*/
	public static function getIntervalLength($duration, $breakCount) {
		$segments = $breakCount + 1;
		return (int)floor($duration / $segments);
	}

	public static function shouldRest(int $minute, array $person): bool
	{
		$intervalLength = empty($person['beginner'])
			? self::getIntervalLength(self::$duration, self::$breaks)
			: self::getIntervalLength(self::$duration, self::$beginnerBreaks);
	
		return $minute > 0 && ($minute % $intervalLength === 0);
	}
}

?>