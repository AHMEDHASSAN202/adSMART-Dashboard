<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = [];

    protected $appends = ['language_image_path'];

    protected $casts = [
        'language_display_front' => 'boolean'
    ];

    protected $primaryKey = 'language_id';


    public function getLanguageImagePathAttribute()
    {
        return _flagSvg($this->language_image);
    }
}
