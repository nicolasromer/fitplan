<?php

include_once('tests.php');

class TestRunner {
	private static function pass($function, $expected, $testName = '') {
		// todo: prepend the test function name. 
		echo "\n\033[32mPASSED\033[0m test case \"".$testName. "\n";
	}

	private static function fail($function, $expected, $actual, $testName = '') {
		echo "\n\033[31mFAILED\033[0m test case \"".$testName
		."\" did not get expected result: \n  "
		. print_r($expected, true) . "\n"
		. "Got this instead: \n"
		. print_r($actual, true)
		. "\n";
	}

	/*
	call the named function with the associated test data
	*/
	public static function runTest($testName) {
		$dataGetter = $testName.'Data';
		$testCases = Tests::${$testName.'Data'};

		foreach ($testCases as $testTitle => $testCase) {

			$result = Tests::$testName($testCase[0]);
			$didPass = $result === $testCase[1];

			if ($didPass) {
				self::pass($testName, $testCase[1], $testTitle);
			} else {
				self::fail($testName, $testCase[1], $result, $testTitle);
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
	'testCreateBootcamp',
	'testAssignExercisesToAll',
	'testGetIntervalLength',
]);

?>