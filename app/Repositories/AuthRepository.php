<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Events\Dashboard\AfterUserLoginToDashboardEvent;
use App\Events\Dashboard\AfterUserLogoutFromDashboardEvent;
use App\Events\Dashboard\BeforeUserLoginToDashboardEvent;
use App\Events\Dashboard\BeforeUserLogoutFromDashboardEvent;

class AuthRepository
{

    public function loginToDashboard($loginToDashboardRequest)
    {
        $user = User::where('user_email', $loginToDashboardRequest->email)->first();

        //check on user
        if (!$user) {
            return false;
        }

        //check password
        if (!Hash::check($loginToDashboardRequest->password, $user->user_password)) {
            return false;
        }

        //check role
        if (!in_array($user->user_role, config('auth.dashboard_roles'))) {
            return false;
        }

        //dispatch before user login event
        event(new BeforeUserLoginToDashboardEvent($user));

        //logged it
        Auth::login($user, (boolean)$loginToDashboardRequest->rememberme);

        //dispatch after user login event
        event(new AfterUserLoginToDashboardEvent($user));

        return true;
    }


    public function logoutFromDashboard()
    {
        $me = Auth::user();

        event(new BeforeUserLogoutFromDashboardEvent($me));

        Auth::logout();

        event(new AfterUserLogoutFromDashboardEvent($me));

        return true;
    }

    public function getProfile()
    {
        return auth()->user();
    }
}
