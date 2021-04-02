<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $primaryKey = 'flag_id';

    public $timestamps = false;

    public $appends = ['flag_path'];

    public function getFlagPathAttribute()
    {
        return _flagSvg($this->flag_svg);
    }
}
