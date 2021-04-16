<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TypesRepository
{
    private $table_name = 'types';

    public function getTypes($type_key=null)
    {
        $allTypes = Cache::rememberForever($this->table_name, function () {
            return DB::table($this->table_name)->get();
        });

        if ($type_key) {
            $types = $allTypes->where('type_key', $type_key);
        }else {
            $types = $allTypes;
        }

        return $types;
    }

    private function clearCache()
    {
        return Cache::forget($this->table_name);
    }

    public function createType(Request $request)
    {
        $created = DB::table($this->table_name)->insert($request->only('type_key', 'type_slug', 'type_value'));

        if (!$created) return false;

        $this->clearCache();

        return true;
    }

    public function updateType(Request $request, $type_id)
    {
        DB::table($this->table_name)->where('type_id', $type_id)->update($request->only('type_slug', 'type_value'));

        $this->clearCache();

        return true;
    }

    public function deleteTypes($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        DB::table($this->table_name)->whereIn('type_id', $ids)->delete();

        $this->clearCache();

        return true;
    }
}
