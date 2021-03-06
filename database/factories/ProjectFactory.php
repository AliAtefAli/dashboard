<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'ar' => ['name' => 'مشروع 1', 'description' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.'],
        'en' => ['name' => 'Project 1', 'description' => $faker->paragraph(1)],
        'logo' => 'assets/web/images/temp/project-image.svg',
        'total_pay' => $faker->numberBetween(3000, 30000),
        'user_id' => 1,
    ];
});
