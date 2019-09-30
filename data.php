<?php


$duration = 30;

$breaks = 2;

$beginnerBreaks = 4;

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
		'beginner' => false,
	],
	[
		'name' => 'Michael',
		'beginner' => false,
	],
	[
		'name' => 'Tom',
		'beginner' => true,
	],
	[
		'name' => 'Tim',
		'beginner' => false,
	],
	[
		'name' => 'Erik',
		'beginner' => false,
	],
	[
		'name' => 'Lars',
		'beginner' => false,
	],
	[
		'name' => 'Mathijs',
		'beginner' => true,
	],
];


?>