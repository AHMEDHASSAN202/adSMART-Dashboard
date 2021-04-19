<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('types')->insert([
            [
                'type_key'      => 'page_type',
                'type_slug'     => 'header',
                'type_value'    => 'Header',
            ],
            [
                'type_key'      => 'page_type',
                'type_slug'     => 'footer',
                'type_value'    => 'Footer'
            ],
            [
                'type_key'      => 'page_type',
                'type_slug'     => 'sidebar',
                'type_value'    => 'Sidebar'
            ]
        ]);

        $page1 = Page::create(['fk_type_id' => 1]);
        $page2 = Page::create(['fk_type_id' => 1]);
        $page3 = Page::create(['fk_type_id' => 2]);
        $page4 = Page::create(['fk_type_id' => 2]);

        DB::table(Page::PageDescriptionTable)->insert(
            [
                [
                    'fk_page_id'      => $page1->page_id,
                    'fk_language_id'  => 1,
                    'page_slug'       => 'about-us',
                    'page_title'      => 'About us',
                    'page_content'    => 'About us About us',
                ],
                [
                    'fk_page_id'      => $page1->page_id,
                    'fk_language_id'  => 2,
                    'page_slug'       => 'من-نحن',
                    'page_title'      => 'من نحن',
                    'page_content'    => 'من نحن',
                ],
                [
                    'fk_page_id'      => $page2->page_id,
                    'fk_language_id'  => 1,
                    'page_slug'       => 'terms',
                    'page_title'      => 'Terms',
                    'page_content'    => 'Terms Terms Terms',
                ],
                [
                    'fk_page_id'      => $page2->page_id,
                    'fk_language_id'  => 2,
                    'page_slug'       => 'شروط-الخدمة',
                    'page_title'      => 'شروط الخدمة',
                    'page_content'    => 'شروط الخدمة شروط الخدمة',
                ],
                [
                    'fk_page_id'      => $page3->page_id,
                    'fk_language_id'  => 1,
                    'page_slug'       => 'privacy',
                    'page_title'      => 'Privacy',
                    'page_content'    => 'privacy privacy',
                ],
                [
                    'fk_page_id'      => $page3->page_id,
                    'fk_language_id'  => 2,
                    'page_slug'       => 'الخصوصية',
                    'page_title'      => 'الخصوصية',
                    'page_content'    => 'الخصوصية الخصوصية الخصوصية ',
                ],
                [
                    'fk_page_id'      => $page4->page_id,
                    'fk_language_id'  => 1,
                    'page_slug'       => 'security',
                    'page_title'      => 'Security',
                    'page_content'    => 'Security Security',
                ],
                [
                    'fk_page_id'      => $page4->page_id,
                    'fk_language_id'  => 2,
                    'page_slug'       => 'الامان',
                    'page_title'      => 'الامان',
                    'page_content'    => 'الامان الامان',
                ]
            ]
        );
    }
}
