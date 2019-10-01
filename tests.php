<?php

include('helpers.php');
include('planner.php');

class Tests {

	public static function testIntroduce($case) {
		$helpers = new Helpers();
		return Helpers::introduce($case);
	}

	static $testIntroduceData = [
		'one person' => [
			// input
			[['name'=>'Michelle']],

			// expected result
			'Today\'s participants are Michelle.'
		],

		'beginner' => [
			[[
				'name'=>'Michelle',
				'beginner' => true,
			]],

			'Today\'s participants are Michelle (beginner).'
		],

		'multiple people' => [
			[[
				'name'=>'Michelle',
			],[
		    	'name' => 'Bobby',
			]],

			'Today\'s participants are Michelle, and Bobby.'
		],
	];

	public static function testPlanWorkout($testCase) {
		return Planner::planWorkout(
			$testCase['participants'],
			$testCase['exercises'],
			$testCase['duration']
		);
	}

	static $testPlanWorkoutData = [
		'creates basic plan' => [
			[
				'participants' => [['name' => 'Jack']],
				'exercises' => [[
					'name' => 'deadlifts',
				]],
				'duration' => 5,
			],
			[
				[
					'Jack' =>'deadlifts',
				],[
					'Jack' =>'rest',
				],[
					'Jack' =>'deadlifts',
				],[
					'Jack' =>'rest',
				],[
					'Jack' =>'deadlifts',
				]
			]
		]
	];

	public static function testGetParticipantHistory($case) {
		return Planner::getParticipantHistory($case['name'], $case['history']);
	}

	static $testGetParticipantHistoryData = [
		'gets history' => [
			[
				'name' => 'Ryan',
				'history' => [
					'Minute 1' => [
						'Ryan' => 'foo',
					],
					'Minute 2' => [
						'Ryan' => 'bar',
					],
					'Minute 3' => [
						'Ryan' => 'grill',
						'Megan' => 'spam',
					]
				],
			],
			['foo', 'bar', 'grill'],
		],
	];

	public static function testCreateBootcamp($case) {
		return Planner::createBootcamp($case);
	}

	static $testCreateBootcampData = [
		'gets basic exercises interspersed with cardio' => [
			[
				[
					'name' => 'push ups',
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
					'name' => 'jumping jacks',
					'cardio' => true,
				],
				[
					'name' => 'handstand practice',
					'expert' => true,
				],
			],
			['short sprints', 'push ups'],
		]
	];
}


?>