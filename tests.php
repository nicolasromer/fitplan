<?php

include('helpers.php');

class Tests {

	public static function testIntroduce($data) {
		$helpers = new Helpers();
		return Helpers::introduce($data[0]) === Helpers::$introText . $data[1];
	}

	static $testIntroduceData = [
		[[['name'=>'Michelle']], 'Michelle.'],
	];
}

class TestRunner {
	private static function pass($function) {
		echo 'test "' . $function . "\" passed √ :) \r\n";
	}

	private static function fail($function) {
		echo $function . " Failed X :( \r\n";
	}

	// call the named function with the associated test data
	public static function runTest($testName) {
		$dataGetter = $testName.'Data';
		$testCases = Tests::${$testName.'Data'};
		foreach ($testCases as $testCase) {

			$didPass = Tests::$testName($testCase);

			if ($didPass) {
				self::pass($testName);
			} else {
				self::fail($testName);
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