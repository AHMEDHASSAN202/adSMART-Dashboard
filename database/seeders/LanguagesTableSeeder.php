<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Language::insert([
            [
                'language_name'          => 'English',
                'language_code'          => 'en',
                'language_direction'     => 'ltr',
                'language_display_front' => true,
                'language_image'         => '226-united-states.svg'
            ], [
                'language_name'          => 'عربي',
                'language_code'          => 'ar',
                'language_direction'     => 'rtl',
                'language_display_front' => true,
                'language_image'         => '158-egypt.svg'
            ]
        ]);
    }
}
