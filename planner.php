<?php

import "data.php";

class Planner {

	public function planWorkout(
		array $participants,
		array $exercises
		int $duration,
		int $breaks,
		int $beginnerBreaks
	): void {
		
		// I'm going to create an array for each minute
		// so we can store all the data from the workout
		// for analytics or other future reference.
		$plannedMinutes = []

		for ($i=0; $i < $duration; $i++) { 
		 	
			$plan = array_map(function() {
				
			}, $participants)

		 } 

	}

	private static assignExercise(array $participant): array 
	{

	}

}

?>