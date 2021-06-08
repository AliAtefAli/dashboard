<?php

use App\Models\Option;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Option::class, function (Faker $faker) {
    return [
        'image' => 'assets/web/images/temp/project-logo.svg',
        'project_steps_id' => 2,
    ];
});
