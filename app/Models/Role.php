<?php

namespace App\Models;

use App\Classes\Utilities;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'role_id';

    const RoleDescriptionTable = 'roles_description';

    public function scopeRoleDescription($query)
    {
        return $query->join(Role::RoleDescriptionTable, 'roles.role_id', '=', Role::RoleDescriptionTable.'.fk_role_id');
    }

    public function scopeLanguage($query)
    {
        $languageId = Utilities::getLanguage()->language_id;

        return $query->where(Role::RoleDescriptionTable.'.fk_language_id', $languageId);
    }

    public function scopeSearch($query, $request)
    {
        if ($s = $request->input('query.s')) {
            return $query->where(Role::RoleDescriptionTable.'.name', 'LIKE', '%' . $s . '%');
        }
    }

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions);
    }
}
