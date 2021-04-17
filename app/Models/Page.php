<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'page_id';

    protected $appends = ['feature_image_full_path'];

    const PageDescriptionTable = 'pages_description';

    public function scopePageDescription($query)
    {
        $languageId = getLanguage()->language_id;
        return $query->leftJoin(Page::PageDescriptionTable, function ($join) use ($languageId) {
            $join->on('page_id', '=', Page::PageDescriptionTable.'.fk_page_id')->where(Page::PageDescriptionTable.'.fk_language_id', $languageId);
        });
    }

    public function scopePageType($query)
    {
        return $query->join('types', 'pages.fk_type_id', '=', 'types.type_id');
    }

    public function getFeatureImageFullPathAttribute()
    {
        return asset("storage/$this->feature_image");
    }
}
