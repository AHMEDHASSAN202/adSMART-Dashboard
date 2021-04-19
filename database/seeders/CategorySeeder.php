<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $category1 = Category::create(['sort_order' => 1]);
        $category2 = Category::create(['sort_order' => 2]);
        $category6 = Category::create(['parent_id' => $category1->category_id, 'sort_order' => 1]);
        $category7 = Category::create(['parent_id' => $category1->category_id, 'sort_order' => 1]);
        $category3 = Category::create(['parent_id' => $category7->category_id, 'sort_order' => 1]);
        $category4 = Category::create(['parent_id' => $category7->category_id, 'sort_order' => 2]);
        $category8 = Category::create(['parent_id' => $category6->category_id, 'sort_order' => 2]);
        $category5 = Category::create(['parent_id' => $category2->category_id, 'sort_order' => 1]);

        DB::table(Category::CategoryDescriptionTable)->insert(
            [
                [
                    'fk_category_id'      => $category1->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'web',
                    'category_name'      => 'Web',
                    'category_description'    => 'Web',
                ],
                [
                    'fk_category_id'      => $category1->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'ويب',
                    'category_name'      => 'ويب',
                    'category_description'    => 'ويب',
                ],
                [
                    'fk_category_id'      => $category2->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'mobile',
                    'category_name'      => 'Mobile',
                    'category_description'    => 'Mobile',
                ],
                [
                    'fk_category_id'      => $category2->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'موبايل',
                    'category_name'      => 'موبايل',
                    'category_description'    => 'موبايل',
                ],
                [
                    'fk_category_id'      => $category3->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'php',
                    'category_name'      => 'PHP',
                    'category_description'    => 'php',
                ],
                [
                    'fk_category_id'      => $category3->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'بي-اتش-بي',
                    'category_name'      => 'بي اتش بي',
                    'category_description'    => 'بي اتش بي',
                ],
                [
                    'fk_category_id'      => $category4->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'node-js',
                    'category_name'      => 'Node js',
                    'category_description'    => 'Node js',
                ],
                [
                    'fk_category_id'      => $category4->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'نود-جي-اس',
                    'category_name'      => 'نود جي اس',
                    'category_description'    => 'نود جي اس',
                ],
                [
                    'fk_category_id'      => $category5->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'react-native',
                    'category_name'      => 'React Native',
                    'category_description'    => 'React Native',
                ],
                [
                    'fk_category_id'      => $category5->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'رياكت-نتيف',
                    'category_name'      => 'رياكت نتيف',
                    'category_description'    => 'رياكت نتيف',
                ],
                [
                    'fk_category_id'      => $category7->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'backend',
                    'category_name'      => 'BackEnd',
                    'category_description'    => 'BackEnd',
                ],
                [
                    'fk_category_id'      => $category7->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'باك-ايند',
                    'category_name'      => 'باك ايند',
                    'category_description'    => 'باك ايند',
                ],
                [
                    'fk_category_id'      => $category6->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'frontend',
                    'category_name'      => 'Frontend',
                    'category_description'    => 'Frontend',
                ],
                [
                    'fk_category_id'      => $category6->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'فرونت-ايند',
                    'category_name'      => 'فرونت ايند',
                    'category_description'    => 'فرونت ايند',
                ],
                [
                    'fk_category_id'      => $category8->category_id,
                    'fk_language_id'  => 1,
                    'category_slug'       => 'react',
                    'category_name'      => 'React',
                    'category_description'    => 'React',
                ],
                [
                    'fk_category_id'      => $category8->category_id,
                    'fk_language_id'  => 2,
                    'category_slug'       => 'رياكت',
                    'category_name'      => 'رياكت',
                    'category_description'    => 'رياكت',
                ]
            ]
        );
    }
}
