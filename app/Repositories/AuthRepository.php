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
use Illuminate\Support\MessageBag;

class AuthRepository
{
    private $dashboardGuard = 'dashboard';
    protected $dashboardPermission = 'dashboard-browse';

    public function loginToDashboard($loginToDashboardRequest)
    {
        $user = User::where('user_email', $loginToDashboardRequest->email)->first();

        //check on user
        if (!$user) {
            $status = new MessageBag();
            $status->add('email_or_password', _e('invalid_email_or_password_msg'));
            return $status;
        }

        //check password
        if (!Hash::check($loginToDashboardRequest->password, $user->user_password)) {
            $status = new MessageBag();
            $status->add('email_or_password', _e('invalid_email_or_password_msg'));
            return $status;
        }

        //check permissions
        if (!$user->hasPermissions($this->dashboardPermission)) {
            $status = new MessageBag();
            $status->add('email_or_password', _e('invalid_email_or_password_msg'));
            return $status;
        }

        //dispatch before user login event
        event(new BeforeUserLoginToDashboardEvent($user));

        //logged it
        Auth::guard($this->dashboardGuard)->login($user, (boolean)$loginToDashboardRequest->rememberme);

        //dispatch after user login event
        event(new AfterUserLoginToDashboardEvent($user));

        return true;
    }


    public function logoutFromDashboard()
    {
        $me = Auth::guard($this->dashboardGuard)->user();

        event(new BeforeUserLogoutFromDashboardEvent($me));

        Auth::guard($this->dashboardGuard)->logout();

        event(new AfterUserLogoutFromDashboardEvent($me));

        return true;
    }

    public function getProfile()
    {
        return auth($this->dashboardGuard)->user();
    }
}
