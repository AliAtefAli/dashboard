<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Link::class, function (Faker $faker) {
    return [
        'ar' => ['title' => 'اللينك4532'],
        'en' => ['title' => 'The link 5'],
        'path' => 'http://github.com/5',
        'project_steps_id' => 3,
    ];
});
