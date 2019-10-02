# fitplan
pure php fitness app prototype

minimum requirements: PHP 7.1

to run tests: clone the repo and run 'make' in the root.

For this exercise I wanted to take a test driven approach. I created a scaffolding for easily creating test cases by adding input/expected pairs to an array. There is helpful output shown in the console when running tests. I wrote tests first then created the functions to get those tests passsing.

I used a functional paradigm because I know the importance of keeping data intact and functions pure for testablity. It also will allow us to easily add new features and refactor going forward.

The problem is pretty complex at first glance. I thought it would be easier if I could reduce the problem space by creating a block of exercises and rests that answered to a few of the criteria. The initial 'bootcamp' phase of the workout has everyone participate in the same exercises at the same times. they are cardio and non-cardio intersperced and people take breaks when they need based on their level. 

I prioritized the cardio rule and the rests rule because they seem like necessary elements of a basic workout. We can add in things like handstands and limited-use gym equipment as bonus features. For now we want to get the most people involved with the least code overhead.

TODOs:
- The 'limited space' rule
- The 'handstand' rule
- The logger creating the output

files
---
test_runner.php:
- this is where we have the loggers and test running function. Takes a function name and runs that function once for each entry in the {functionName}Data array, then compares the output to the expected data provided.

tests.php:
- The tests functions and test data. here's where we write new tests.

TODO:
Logger (currently helpers.php):
- this is where the logging functions will go to transform the workout plan array to useful output.

Planner:
- Where the core logic resides for planning the workout.





