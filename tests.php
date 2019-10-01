<?php

include('helpers.php');
include('planner.php');

class Tests {

	public static function testIntroduce($case) {
		$helpers = new Helpers();
		return Helpers::introduce($case);
	}

	static $testIntroduceData = [

		[
			// input
			[['name'=>'Michelle']],

			// expected result
			'Today\'s participants are Michelle.'
		],

		[
			[[
				'name'=>'Michelle',
				'beginner' => true,
			]],

			'Today\'s participants are Michelle (beginner).'
		],

		[
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
		[
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
		[
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
}



class TestRunner {
	private static function pass($function, $expected) {
		echo "\nPASSED test case for \"" . $function . "\" with result: \r\n  "
		. print_r($expected, true)
		. "\n";
	}

	private static function fail($function, $expected, $actual) {
		echo "\nFAILED test case for \"".$function."\" did not get expected result: \n  "
		. print_r($expected, true) . "\n"
		. "Got this instead: \n"
		. print_r($actual, true)
		. "\n";
	}

	// call the named function with the associated test data
	public static function runTest($testName) {
		$dataGetter = $testName.'Data';
		$testCases = Tests::${$testName.'Data'};
		foreach ($testCases as $testCase) {

			$result = Tests::$testName($testCase[0]);
			$didPass = $result === $testCase[1];

			if ($didPass) {
				self::pass($testName, $testCase[1]);
			} else {
				self::fail($testName, $testCase[1], $result);
			}
		}
	}

    public static function run($tests) {
    	foreach ($tests as $testName) {
    		self::runTest($testName);
    	}
    }
}

// Run the tests!
TestRunner::run([
	//'testIntroduce',
	'testPlanWorkout',
	'testGetParticipantHistory',
]);

?>