<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesRepository
{
    public function getRoles()
    {
        $cacheKey = 'roles:' . app()->getLocale();

        $roles = Cache::rememberForever($cacheKey, function () {
            return Role::orderBy('role_id', 'DESC')->roleDescription()->get();
        });

        return $roles;
    }

    private function clearCache()
    {
        return Cache::forget('roles:' . app()->getLocale());
    }

    public function getRolesForSelectable()
    {
        return $this->getRoles();
    }

    public function addNewRole($data)
    {
        $permissions = empty($data['permissions']) ? [] : $data['permissions'];
        $role = Role::create(['permissions' => json_encode($permissions)]);
        if (!$role) return false;

        $d = [];
        $languages = getLanguages();
        foreach ($languages as $language) {
            $d[] = [
                'fk_role_id'     => $role->role_id,
                'fk_language_id' => $language->language_id,
                'name' => $data['role_name'][$language->language_code],
                'created_at' => now()
            ];
        }

        DB::table('roles_description')->insert($d);

        $this->clearCache();

        return true;
    }

    public function getRole($role)
    {
        $roleDescriptions = DB::table(Role::RoleDescriptionTable)->where(['fk_role_id' => $role->role_id])->get();
        $res['role_id'] = $role->role_id;
        $res['permissions'] = $role->permissions;
        $res['role_name'] = [];
        foreach ($roleDescriptions as $description) {
            $languageCode = getLanguage(null, $description->fk_language_id)->language_code;
            $res['role_name'][$languageCode] = $description->name;
        }
        return $res;
    }

    public function updateRole($role_id, $data)
    {
        $permissions = empty($data['permissions']) ? [] : $data['permissions'];
        Role::where('role_id', $role_id)->update(['permissions' => json_encode($permissions)]);
        $languages = getLanguages();
        foreach ($languages as $language) {
            DB::table(Role::RoleDescriptionTable)->updateOrInsert(
                ['fk_role_id' => $role_id, 'fk_language_id' => $language->language_id],
                ['name' => $data['role_name'][$language->language_code]]
            );
        }

        $this->clearCache();
    }

    public function deleteRoles($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        //used delete model for fire deleted event
        foreach ($ids as $role_id) {
            Role::findOrFail($role_id)->delete();
        }

        $this->clearCache();
    }
}
