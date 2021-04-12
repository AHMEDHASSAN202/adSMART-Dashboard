<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $role1 = Role::create([
            'permissions' => json_encode(getAllPermissions(false))
        ]);
        DB::table(Role::RoleDescriptionTable)->insert(
            [
                [
                    'fk_role_id'    => $role1->role_id,
                    'fk_language_id' => 1,
                    'name'      => 'Admin'
                ],
                [
                    'fk_role_id'    => $role1->role_id,
                    'fk_language_id' => 2,
                    'name'      => 'مدير الموقع'
                ]
            ]
        );

        $role2 = Role::create([
            'permissions' => json_encode([])
        ]);
        DB::table(Role::RoleDescriptionTable)->insert(
            [
                [
                    'fk_role_id'    => $role2->role_id,
                    'fk_language_id' => 1,
                    'name'      => 'User'
                ],
                [
                    'fk_role_id'    => $role2->role_id,
                    'fk_language_id' => 2,
                    'name'      => 'مستخدم'
                ]
            ]
        );
    }
}
