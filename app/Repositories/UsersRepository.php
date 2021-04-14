<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;

class UsersRepository
{
    public function getUsers(Request $request)
    {
        $perPage = $request->query('perpage', config('myapp.paginationPerPage'));

        return User::with('role:role_id,name')->latest()->search($request)->paginate($perPage)->appends($request->query());
    }

    public function removeUsers($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        $deleteUsers = User::whereIn('user_id', $ids)->get();

        $deleteUsers->map(function ($user) { $user->delete(); });

        return true;
    }
}
