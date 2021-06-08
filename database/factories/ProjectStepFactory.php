<?php

use App\Models\ProjectStep;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ProjectStep::class, function (Faker $faker) {
    return [
        'project_id' =>1,
        'step_id' => 4,
    ];
});

$factory->afterCreating(App\Models\ProjectStep::class, function ($projectStep, $faker) {
    $projectStep->links()->save(factory(App\Models\Link::class)->make());
    $projectStep->options()->save(factory(App\Models\Option::class)->make());
    $projectStep->installments()->save(factory(App\Models\Installment::class)->make());
});
