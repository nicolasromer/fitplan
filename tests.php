<?php

include 'helpers.php';

class Tests {
	public static function testIntroduce($data) {
		return Helpers::introduce($data[0]) === Helpers::$introText . $data[1];
	}

	static $testIntroduceData = [
		[['Michelle'], 'Michelle.'],
	];
}

class TestRunner {
	private function pass($function) {
		echo $function . ' passed √ :) \r\n';
	}

	private function fail($function) {
		echo $function . ' Failed X :( \r\n';
	}

	// call the named function with the associated test data
	public static function runTest($testName) {
		$dataGetter = $testName.'Data';
		$testCases = Tests::${$testName.'Data'};
		foreach ($testCases as $testCase) {

			$didPass = Tests::$testName($testCase);

			if ($didPass) {
				pass($testName);
			} else {
				fail($testName);
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