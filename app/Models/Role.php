<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'role_id';

    const RoleDescriptionTable = 'roles_description';

    public function scopeRoleDescription($query)
    {
        $languageId = getLanguage()->language_id;
        return $query->leftJoin(Role::RoleDescriptionTable, function ($join) use ($languageId) {
            $join->on('roles.role_id', '=', Role::RoleDescriptionTable.'.fk_role_id')
                 ->where(Role::RoleDescriptionTable.'.fk_language_id', $languageId);
        });
    }

    public function scopeSearch($query, $request)
    {
        if ($s = $request->query('s')) {
            return $query->where(Role::RoleDescriptionTable.'.name', 'LIKE', '%' . $s . '%');
        }
    }

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions);
    }
}
