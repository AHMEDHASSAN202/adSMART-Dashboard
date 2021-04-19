<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'category_id';

    protected $appends = ['image_full_path'];

    const CategoryDescriptionTable = 'categories_description';

    public function scopeCategoryDescription($query)
    {
        $languageId = getLanguage()->language_id;
        return $query->leftJoin(Category::CategoryDescriptionTable, function ($join) use ($languageId) {
            $join->on('category_id', '=', Category::CategoryDescriptionTable.'.fk_category_id')->where(Category::CategoryDescriptionTable.'.fk_language_id', $languageId);
        });
    }

    public function getImageFullPathAttribute()
    {
        return asset("storage/$this->image");
    }
}
