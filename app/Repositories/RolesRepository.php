<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use App\Classes\Utilities;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesRepository
{
    public function getRoles(Request $request)
    {
        $page = $request->input('pagination.page', 1);
        $perPage = Utilities::$paginationPerPage;

        return Role::select(
                'roles.role_id',
                'roles.created_at',
                'name',
                'fk_language_id'
            )->roleDescription()->language()->search($request)->paginate($perPage, ['*'], 'page', $page);
    }

    public function showRolesColumns(LengthAwarePaginator $roles)
    {
        $ktDatatableData = collect([]);

        $roles->map(function ($role, $i) use ($ktDatatableData) {
            $actionButtons = Utilities::editHtmlButton(route('roles.index', ['editRole' => $role->role_id])) . Utilities::deleteHtmlButton(route('roles.delete_role'), $role->role_id);
            $c = [
                '#' => Utilities::checkBoxHtmlInput($role->role_id),
                _e('name') => $role->name,
                _e('created_at') => $role->created_at ? $role->created_at->format('Y-m-d') : null,
                _e('actions') => $actionButtons
            ];
            $ktDatatableData->push($c);
        });

        $roles->setCollection($ktDatatableData);

        return $roles;
    }

    public function addNewRole($data)
    {
        $permissions = empty($data['permissions']) ? [] : $data['permissions'];
        $role = Role::create(['permissions' => json_encode(array_keys($permissions))]);
        if (!$role) return false;
        $d = [];
        $languages = Utilities::getLanguages();
        foreach ($languages as $language) {
            $d[] = [
                'fk_role_id'     => $role->role_id,
                'fk_language_id' => $language->language_id,
                'name' => $data['role_name'][$language->language_code],
                'created_at' => now()
            ];
        }
        return DB::table('roles_description')->insert($d);
    }

    public function getRole($role_id)
    {
        $role = Role::findOrFail($role_id);
        $roleDescriptions = DB::table(Role::RoleDescriptionTable)->where(['fk_role_id' => $role->role_id])->get();
        $res['role_id'] = $role->role_id;
        $res['permissions'] = $role->permissions;
        $res['role_name'] = [];
        foreach ($roleDescriptions as $description) {
            $res['role_name'][$description->fk_language_id] = $description->name;
        }
        return $res;
    }

    public function updateRole($role_id, $data)
    {
        $permissions = empty($data['permissions']) ? [] : $data['permissions'];
        Role::where('role_id', $role_id)->update(['permissions' => json_encode(array_keys($permissions))]);
        $languages = Utilities::getLanguages();
        foreach ($languages as $language) {
            DB::table(Role::RoleDescriptionTable)->updateOrInsert(
                ['fk_role_id' => $role_id, 'fk_language_id' => $language->language_id],
                ['name' => $data['role_name'][$language->language_code]]
            );
        }
    }

    public function deleteRoles($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        //used delete model for fire deleted event
        foreach ($ids as $role_id) {
            Role::findOrFail($role_id)->delete();
        }
    }
}
