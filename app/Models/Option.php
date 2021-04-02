<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'option_id';


    public function isCurrentLanguage()
    {
        return $this->option_key === 'default_lang';
    }

}
