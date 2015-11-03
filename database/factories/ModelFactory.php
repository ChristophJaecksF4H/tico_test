<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\Project::class, function (Faker\Generator $faker) {
	return [
		'name' => str_random(5)
	];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {
	return [
		'id' => $faker->unique()->numberBetween(1, 350),
		'project_id' => rand(1, 5)
	];
});