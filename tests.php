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
					'name' => 'back squats',
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
			['short sprints', 'push ups', 'jumping jacks', 'back squats'],
		]
	];

	public static function testAssignExercisesToAll($case) {
		return Planner::assignExercisesToAll($case['exercises'], $case['participants']);
	}

	static $testAssignExercisesToAllData = [
		'creates a minute for each exercise for everyone' => [
			[
				'exercises' => ['foo', 'bar'],
				'participants' => [['name'=>'Joe'],['name'=>'Jill'],['name'=>'Jasper']]
			],
			[
				[
					[
						'participant' => 'Joe',
						'activity' => 'foo',
					],[
						'participant' => 'Jill',
						'activity' => 'foo',
					],[
						'participant' => 'Jasper',
						'activity' => 'foo',
					]
				],[
					[
						'participant' => 'Joe',
						'activity' => 'bar',
					],[
						'participant' => 'Jill',
						'activity' => 'bar',
					],[
						'participant' => 'Jasper',
						'activity' => 'bar',
					]
				]
			]
		]
	];

	public static function testGetIntervalLength($case) {
		return Planner::getIntervalLength($case[0], $case[1]);
	}

	static $testGetIntervalLengthData = [
		'minimum workout' => [
			[3, 1],
			1
		],
		'short workout' => [
			[5, 2],
			1
		],
		'ok workout' => [
			[10, 1],
			5
		],
		'real workout' => [
			[30, 2],
			10
		],
	];
}


?>