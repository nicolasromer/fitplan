# fitplan
pure php fitness app prototype

minimum requirements: PHP 7.1

to run tests: clone the repo and run 'make' in the root.

For this exercise I wanted to take a test driven approach. I created a scaffolding for easily creating test cases by adding input/expected pairs to an array. There is helpful output shown in the console when running tests. Here are some major tasks remaining to complete the project:

- Refactor tests to allow providing a test name
- Implement validation on inputs to the fitness planner (e.g. duration vs breaks)
- Implement the logic for adding rests into workouts
- Implement the logic for high-demand equipment
- Organize Makefile to have separate 'test' and 'plan' commands
- Create Output module to take the arrays created by the planner and output something logical

Some of the core logic implementation requires me to learn more about working with arrays in PHP. There is also some algorithm design to be done to optimize the complex looping happening in the planner, or maybe just better knowledge of PHP built-in functions. 

There's much more to do here.



