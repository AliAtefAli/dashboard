<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Installment::class, function (Faker $faker) {
    return [
        'ar' => ['title' => 'الدفعة الاخيرة','description' => 'en'],
        'en' => ['title' => 'The installment','description' => 'ar'],
        'price' => 15000.50,
        'project_steps_id' => 2,


    ];
});
