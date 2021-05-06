<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;



use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PagesRepository
{
    public function getPages($type=null)
    {
        $cacheKey = 'pages:' . app()->getLocale();

        $pages = Cache::rememberForever($cacheKey, function () {
            return Page::pageDescription()->pageType()->latest('pages.created_at')->get();
        });

        if ($type) {
            $pages = $pages->where('type_slug', $type);
        }

        return $pages;
    }

    private function clearCache()
    {
        return clearCacheAllLanguages('pages');
    }

    public function createPage(Request $request)
    {
        try {
            $data = $request->only(['fk_type_id']);
            if ($request->hasFile('feature_image')) {
                $data['feature_image'] = $request->file('feature_image')->store('images/pages/feature_images', 'public');
            }
            $page = Page::create($data);
            $languages = getLanguages();
            $pageDescriptions = [];
            foreach ($languages as $language) {
                $pageDescriptions[] = [
                    'fk_page_id'        => $page->page_id,
                    'fk_language_id'    => $language->language_id,
                    'page_title'        => $request->page_title[$language->language_code],
                    'page_slug'         => $request->page_slug[$language->language_code],
                    'page_content'      => $request->page_content[$language->language_code],
                ];
            }
            DB::table(Page::PageDescriptionTable)->insert($pageDescriptions);
            $this->clearCache();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function getPage($page_id)
    {
        $page = Page::where('page_id', $page_id)->firstOrFail()->toArray();
        $pageDescriptions = DB::table(Page::PageDescriptionTable)->where('fk_page_id', $page_id)->get();
        $languages = getLanguages();
        foreach ($languages as $language) {
            $description = $pageDescriptions->where('fk_language_id', $language->language_id)->first();
            $langCode = $language->language_code;
            $page['page_title'][$langCode] = $description ? $description->page_title : '';
            $page['page_slug'][$langCode] = $description ? $description->page_slug : '';
            $page['page_content'][$langCode] = $description ? $description->page_content : '';
        }

        return $page;
    }

    public function updatePage($page_id, Request $request)
    {
        $page = Page::where('page_id', $page_id)->firstOrFail();
        try {
            $page->fk_type_id = $request->fk_type_id;
            if ($request->hasFile('feature_image')) {
                $page->feature_image = $request->file('feature_image')->store('images/pages/feature_images', 'public');
            }
            //clear old feature image
            if ($page->isDirty('feature_image')) {
                Storage::disk('public')->delete($page->getOriginal('feature_image'));
            }
            $page->save();
            $languages = getLanguages();
            foreach ($languages as $language) {
                $pageDescriptions = [
                    'page_title'        => $request->page_title[$language->language_code],
                    'page_slug'         => $request->page_slug[$language->language_code],
                    'page_content'      => $request->page_content[$language->language_code],
                ];
                DB::table(Page::PageDescriptionTable)->updateOrInsert(
                    ['fk_page_id' => $page_id, 'fk_language_id' => $language->language_id],
                    $pageDescriptions
                );
            }
            $this->clearCache();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function deletePages($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        try {
            $pages = Page::select('page_id', 'feature_image')->whereIn('page_id', $ids)->get();

            Storage::disk('public')->delete($pages->pluck('feature_image'));

            Page::whereIn('page_id', $pages->pluck('page_id'))->delete();

            $this->clearCache();

            return true;
        }catch (\Exception $exception) {
            return false;
        }
    }

    public function getCountPages()
    {
        return DB::table(Page::getTableName())->count('page_id');
    }
}
