<?php

include('helpers.php');

class Tests {

	public static function testIntroduce($data) {
		$helpers = new Helpers();
		return Helpers::introduce($data[0]) === Helpers::$introText . $data[1];
	}

	static $testIntroduceData = [

		[
			// input
			[['name'=>'Michelle']],

			// expected result
			'Michelle.'
		],

		[
			[[
				'name'=>'Michelle',
				'beginner' => true,
			]],

			'Michelle (beginner).'
		],

		[
			[[
				'name'=>'Michelle',
			],[
		    	'name' => 'Bobby',
			]],

			'Michelle, and Bobby.'
		],

		[
			[[
				'name'=>'Michelle',
			],[
		    	'name' => 'Bobby',
		    	'beginner' => true
			],[
		    	'name' => 'Esther',
			]],

			'Michelle, Bobby (beginner) and Esther.'
		],
	];
}

class TestRunner {
	private static function pass($function, $expected) {
		echo 'PASSED test case for "' . $function . "\" with result: \r\n  "
		. print_r($expected, true) . "\n\n";
	}

	private static function fail($function, $expected) {
		echo 'FAILED test case for "'.$function."\" did not get expected result: \n  "
		. print_r($expected, true) . "\n\n";
	}

	// call the named function with the associated test data
	public static function runTest($testName) {
		$dataGetter = $testName.'Data';
		$testCases = Tests::${$testName.'Data'};
		foreach ($testCases as $testCase) {

			$didPass = Tests::$testName($testCase);

			if ($didPass) {
				self::pass($testName, $testCase[1]);
			} else {
				self::fail($testName, $testCase[1]);
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
	'testIntroduce',
]);

?>