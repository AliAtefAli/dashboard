<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    private $settings = [
        [
            'key' => 'ar_name',
            'value' => 'سيستم اوامر',
        ],
        [
            'key' => 'en_name',
            'value' => 'Awamer System',
        ],
        [
            'key' => 'email',
            'value' => 'aait.info.com',
        ],
        [
            'key' => 'en_description',
            'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ],
        [
            'key' => 'ar_description',
            'value' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص',
        ],
        [
            'key' => 'en_welcome_message',
            'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ],
        [
            'key' => 'ar_welcome_message',
            'value' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص',
        ],
        [
            'key' => 'ar_policies',
            'value' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص',
        ],
        [
            'key' => 'en_policies',
            'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ],
        [
            'key' => 'ar_about',
            'value' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص',
        ],
        [
            'key' => 'en_rights',
            'value' => 'All rights reserved to a vegetarian dinosaur Policies 2020',
        ],
        [
            'key' => 'ar_rights',
            'value' => 'جميع الحقوق محفوظة لنظام اوامر سياسات ٢٠٢٠',
        ],
        [
            'key' => 'en_about',
            'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ],
        [
            'key' => 'logo',
            'value' => 'assets\uploads\settings\logo.png',
        ],
        [
            'key' => 'favicon',
            'value' => 'assets\uploads\settings\logo.png',
        ],
        [
            'key' => 'company_location',
            'value' => 'السعودية - الرياض',
        ],
        [
            'key' => 'social_facebook',
            'value' => 'https://www.facebook.com/',
        ],
        [
            'key' => 'social_twitter',
            'value' => 'https://www.twitter.com/',
        ],
        [
            'key' => 'social_instagram',
            'value' => 'https://www.instagram.com/',
        ],
        [
            'key' => 'social_whatsapp',
            'value' => '5441254245421',
        ],
        [
            'key' => 'social_snapchat',
            'value' => 'https://www.snapchat.com/',
        ],
        [
            'key' => 'social_linkedin',
            'value' => 'https://www.linkedin.com/',
        ],
        [
            'key' => 'work_date_from',
            'value' => 'saturday',
        ],
        [
            'key' => 'work_date_to',
            'value' => 'thursday',
        ],
        [
            'key' => 'work_time_from',
            'value' => '10:00 AM',
        ],
        [
            'key' => 'work_time_to',
            'value' => '06:00 PM',
        ],


    ];

    public function run()
    {
        foreach ($this->settings as $setting) {
            Setting::create($setting);
        }
    }
}
