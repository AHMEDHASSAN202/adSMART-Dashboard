<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::create([
            'fk_role_id' => 1,
            'user_name' => 'ahmed hassan',
            'user_email'    => 'ahmed@gmail.com',
            'user_password' => password_hash(123456, PASSWORD_DEFAULT)
        ]);

        User::create([
            'fk_role_id' => 2,
            'user_name' => 'user',
            'user_email'    => 'user@gmail.com',
            'user_password' => password_hash(123456, PASSWORD_DEFAULT)
        ]);
    }
}
