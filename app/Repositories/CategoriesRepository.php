<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;



use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver;

class CategoriesRepository
{
    public function getCategories()
    {
        $cacheKey = 'categories:' . app()->getLocale();

        $categories = Cache::rememberForever($cacheKey, function () {
            return Category::categoryDescription()->orderBy('sort_order')->latest('categories.created_at')->get();
        });

        return $categories;
    }

    private function clearCache()
    {
        return clearCacheAllLanguages('categories');
    }

    public function createCategory(Request $request)
    {
        try {
            $data = $request->only(['parent_id']);
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images/categories', 'public');
            }
            $maxOrder = (int) Category::where('parent_id', $request->parent_id)->max('sort_order');
            $data['sort_order'] = ++$maxOrder;
            $category = Category::create($data);
            $languages = getLanguages();
            $categoryDescriptions = [];
            foreach ($languages as $language) {
                $categoryDescriptions[] = [
                    'fk_category_id'            => $category->category_id,
                    'fk_language_id'            => $language->language_id,
                    'category_name'             => $request->category_name[$language->language_code],
                    'category_slug'             => $request->category_slug[$language->language_code],
                    'category_description'      => $request->category_description[$language->language_code],
                ];
            }
            DB::table(Category::CategoryDescriptionTable)->insert($categoryDescriptions);
            $this->clearCache();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function getCategory($category_id)
    {
        $category = Category::where('category_id', $category_id)->firstOrFail()->toArray();
        $categoryDescriptions = DB::table(Category::CategoryDescriptionTable)->where('fk_category_id', $category_id)->get();
        $languages = getLanguages();
        foreach ($languages as $language) {
            $description = $categoryDescriptions->where('fk_language_id', $language->language_id)->first();
            $langCode = $language->language_code;
            $category['category_name'][$langCode] = $description ? $description->category_name : '';
            $category['category_slug'][$langCode] = $description ? $description->category_slug : '';
            $category['category_description'][$langCode] = $description ? $description->category_description : '';
        }

        return $category;
    }

    public function updateCategory($category_id, Request $request)
    {
        $category = Category::where('category_id', $category_id)->firstOrFail();
        try {
            $category->parent_id = $request->parent_id;
            if ($request->hasFile('image')) {
                $category->image = $request->file('image')->store('images/categories', 'public');
            }
            //clear old feature image
            if ($category->isDirty('image')) {
                Storage::disk('public')->delete($category->getOriginal('image'));
            }
            if ($category->isDirty('parent_id')) {
                $maxOrder = (int) Category::where('parent_id', $request->parent_id)->max('sort_order');
                $category->sort_order = ++$maxOrder;
            }
            $category->save();
            $languages = getLanguages();
            foreach ($languages as $language) {
                $categoryDescriptions = [
                    'category_name'             => $request->category_name[$language->language_code],
                    'category_slug'             => $request->category_slug[$language->language_code],
                    'category_description'      => $request->category_description[$language->language_code],
                ];
                DB::table(Category::CategoryDescriptionTable)->updateOrInsert(
                    ['fk_category_id' => $category_id, 'fk_language_id' => $language->language_id],
                    $categoryDescriptions
                );
            }
            $this->clearCache();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function deleteCategories($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        try {
            $categories = Category::select('category_id', 'image')->whereIn('category_id', $ids)->get();

            Storage::disk('public')->delete($categories->pluck('images'));

            Category::whereIn('category_id', $categories->pluck('category_id'))->delete();

            Category::whereIn('parent_id', $categories->pluck('category_id'))->update(['parent_id' => null]);

            $this->clearCache();

            return true;
        }catch (\Exception $exception) {
            return false;
        }
    }

    public function sortableCategories($data, $parentId=null)
    {
        if (!is_array($data) || empty($data)) return true;
        try {
            foreach ($data as $key => $value) {
                DB::table(Category::getTableName())->where('category_id', $value['category_id'])->update([
                    'parent_id'  => $parentId,
                    'sort_order' => $key
                ]);
                $this->sortableCategories(@$value['children'], $value['category_id']);
            }
            $this->clearCache();
            return true;
        }catch (\Exception $exception) {
            return false;
        }
    }

    public function getCountCategories()
    {
        return DB::table(Category::getTableName())->count('category_id');
    }
}
