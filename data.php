<?php



$exercises = [
	[
		'name' => 'Jumping jacks',
		'cardio' => true,
	],
	[
		'name' => 'push ups',
	],
	[
		'name' => 'front squats',
	],
	[
		'name' => 'back squats',
	],
	[
		'name' => 'pull ups',
		// can only handle two users at a time
		'limited_space' => true,
	],
	[
		'name' => 'rings',
		'limited_space' => true
	],
	[
		'name' => 'short sprints',
		'cardio' => true,
	],
	[
		'name' => 'handstand practice',
		// beginners only do one per session.
		'expert' => true,
	],
	[
		'name' => 'jumping rope',
		'cardio' => true,
	],
];

$participants = [
	[
		'name' => 'Camille',
	],
	[
		'name' => 'Michael',
	],
	[
		'name' => 'Tom',
		'beginner' => true,
	],
	[
		'name' => 'Tim',
	],
	[
		'name' => 'Erik',
	],
	[
		'name' => 'Lars',
	],
	[
		'name' => 'Mathijs',
		'beginner' => true,
	],
];


?>