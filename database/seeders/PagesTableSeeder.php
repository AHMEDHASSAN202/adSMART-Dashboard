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

        DB::table(Page::PageDescriptionTable)->insert(
            [
                [
                    'fk_page_id'      => $page1->page_id,
                    'fk_language_id'  => 1,
                    'page_slug'       => 'first-page',
                    'page_title'      => 'First Page',
                    'page_content'    => 'First Page First Page First Page ',
                ],
                [
                    'fk_page_id'      => $page1->page_id,
                    'fk_language_id'  => 2,
                    'page_slug'       => 'الصفحة-الاولى',
                    'page_title'      => 'الصفحه الاولى',
                    'page_content'    => 'الصفحه الاولى الصفحه الاولى الصفحه الاولى',
                ]
            ]
        );

        $page2 = Page::create(['fk_type_id' => 1]);

        DB::table(Page::PageDescriptionTable)->insert(
            [
                [
                    'fk_page_id'      => $page2->page_id,
                    'fk_language_id'  => 1,
                    'page_slug'       => 'second-page',
                    'page_title'      => 'Second Page',
                    'page_content'    => 'Second Page Second Page Second Page ',
                ],
                [
                    'fk_page_id'      => $page2->page_id,
                    'fk_language_id'  => 2,
                    'page_slug'       => 'الصفحة-الثانية',
                    'page_title'      => 'الصفحه الثانية',
                    'page_content'    => 'الصفحه الثانية الصفحه الثانية الصفحه الثانية',
                ]
            ]
        );
    }
}
