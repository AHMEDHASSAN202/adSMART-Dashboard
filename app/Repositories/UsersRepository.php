<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersRepository
{
    public function getUsers(Request $request)
    {
        $perPage = $request->query('perpage', config('myapp.paginationPerPage'));

        return User::with('role:role_id,name')->latest()->search($request)->paginate($perPage)->appends($request->query());
    }

    public function getUserForEdit($userId)
    {
        return User::select('user_id', 'fk_role_id', 'user_name', 'user_email', 'user_avatar', 'fk_user_id', 'user_phone', 'fk_user_country', 'user_address', 'flag_id', 'phone_code')
                    ->leftJoin('profiles', 'user_id', '=', 'fk_user_id')
                    ->leftJoin('flags', 'flag_id', '=', 'fk_user_country')
                    ->where('user_id', $userId)
                    ->first();
    }

    public function createUser($request)
    {
        $userData = $request->only('user_avatar', 'user_name', 'user_email', 'user_password', 'fk_role_id');

        if ($request->hasFile('user_avatar')) {
            $userData['user_avatar'] = $userData['user_avatar']->store('images/users/avatars', 'public');
        }

        $userData['user_password'] = Hash::make($userData['user_password']);
        $userData['user_token'] = Str::random(100);
        $newUser = User::create($userData);

        if (!$newUser) return false;

        $profileData = $request->only('user_phone', 'user_address', 'fk_user_country');
        $profileData['fk_user_id'] = $newUser->user_id;

        $newUserProfile = Profile::create($profileData);

        if (!$newUserProfile) return false;

        return true;
    }

    public function updateUser($user, $request)
    {
        if ($request->hasFile('user_avatar')) {
            $user->user_avatar = $request->file('user_avatar')->store('images/users/avatars', 'public');
        }
        if ($request->filled('user_password')) {
            $user->user_password = Hash::make($request->user_password);
        }
        $user->user_name = $request->user_name;
        $user->user_email = $request->user_email;
        $user->fk_role_id = $request->fk_role_id;
        if ($user->isDirty('user_email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        $userProfile = Profile::where('fk_user_id', $user->user_id)->first() ?? new Profile(['fk_user_id' => $user->user_id]);
        $userProfile->user_phone = $request->user_phone;
        $userProfile->user_address = $request->user_address;
        $userProfile->fk_user_country = $request->fk_user_country;
        $userProfile->save();

        return true;
    }

    public function removeUsers($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        $deleteUsers = User::whereIn('user_id', $ids)->get();

        $deleteUsers->map(function ($user) { $user->delete(); });

        return true;
    }

    public function getCountUsers()
    {
        return DB::table(User::getTableName())->count('user_id');
    }

    public function getLatestUsers($limit=5)
    {
        return User::select('user_id', 'fk_role_id', 'user_name', 'user_email', 'user_avatar')->with('role:role_id,name')->latest()->limit($limit)->get();
    }

    public function setDefaultRoleForDeleteRole()
    {
        return DB::table(User::getTableName())->whereNull('fk_role_id')->update(['fk_role_id' => getOptionValue('default_role')]);
    }
}
