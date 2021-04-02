<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'translation_id';

    public static function getTableName()
    {
        return (new static)->getTable();
    }

}
