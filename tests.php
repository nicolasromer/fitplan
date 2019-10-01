<?php

include_once('helpers.php');
include_once('planner.php');

class Tests {

	public static function testIntroduce($case) {
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
		],
		'adds rests for each based on beginner status' => [
			[
				'exercises' => ['foo', 'bar', 'baz', 'boff', 'bin', 'six', 'seven', 'eight', 'nine', 'ten'],
				'participants' => [
					['name'=>'Joe'],
					['name'=>'Jill', 'beginner' => true],
				]
			],
			[
				[['participant' => 'Joe', 'activity' => 'foo'],
				['participant' => 'Jill', 'activity' => 'foo']],
				[['participant' => 'Joe', 'activity' => 'bar'],
				['participant' => 'Jill', 'activity' => 'bar']],
				[['participant' => 'Joe', 'activity' => 'baz'],
				['participant' => 'Jill', 'activity' => 'baz']],
				[['participant' => 'Joe', 'activity' => 'boff'],
				['participant' => 'Jill', 'activity' => 'boff']],
				[['participant' => 'Joe', 'activity' => 'bin'],
				['participant' => 'Jill', 'activity' => 'bin']], 
				[['participant' => 'Joe', 'activity' => 'six'],
				['participant' => 'Jill', 'activity' => 'rest']], // beginner rests @ six
				[['participant' => 'Joe', 'activity' => 'seven'],
				['participant' => 'Jill', 'activity' => 'seven']],
				[['participant' => 'Joe', 'activity' => 'eight'],
				['participant' => 'Jill', 'activity' => 'eight']],
				[['participant' => 'Joe', 'activity' => 'nine'],
				['participant' => 'Jill', 'activity' => 'nine']],
				[['participant' => 'Joe', 'activity' => 'rest'], // expert rests at 10
				['participant' => 'Jill', 'activity' => 'ten']],
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
		'real workout (beginner)' => [
			[30, 4],
			6
		],
	];
}


?>