<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use App\Events\Dashboard\AfterChangeMyProfilePassword;
use App\Events\Dashboard\UserAttemptedToDashboardLogin;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Events\Dashboard\AfterUserLoginToDashboardEvent;
use App\Events\Dashboard\AfterUserLogoutFromDashboardEvent;
use App\Events\Dashboard\BeforeUserLoginToDashboardEvent;
use App\Events\Dashboard\BeforeUserLogoutFromDashboardEvent;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
            event(new UserAttemptedToDashboardLogin($user));
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

    public function getAdmin()
    {
        return auth($this->dashboardGuard)->user();
    }

    public function getProfileAdmin()
    {
        $profile = auth($this->dashboardGuard)->user()->loadMissing('personalInfo');

        return $profile;
    }

    public function isLoggedToDashboard()
    {
        return auth($this->dashboardGuard)->check();
    }

    public function logoutOtherDevices($password)
    {
        try {
            auth($this->dashboardGuard)->logoutOtherDevices($password, 'user_password');
            ActivityLog::removeDashboardLoggedActivities();
            return true;
        } catch (\Exception $exception) {
            $errors = new MessageBag();
            $errors->add('currentPassword', _e('validation::password'));
            return $errors;
        }
    }

    public function updateProfileInfo(Request $request)
    {
        $me = auth($this->dashboardGuard)->user();
        $me->user_name = $request->user_name;
        $me->user_email = $request->user_email;
        if ($request->hasFile('user_avatar')) {
            $me->user_avatar = $request->file('user_avatar')->store('/images/users/avatars', 'public');
        }
        if ($me->isDirty('user_email')) {
            $me->email_verified_at = null;
        }
        $me->save();
    }

    public function sendVerifyEmail(MustVerifyEmail $user)
    {
        VerifyEmail::createUrlUsing(function ($notifiable) {
            return URL::temporarySignedRoute(
                'auth.dashboard.verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        });

        return $user->sendEmailVerificationNotification();
    }

    public function updatePersonalOptions(Request $request)
    {
        $profile = $this->getProfileAdmin()->personalInfo;
        $profile->fk_user_country = $request->fk_user_country;
        $profile->user_address = $request->user_address;
        $profile->user_phone = $request->user_phone;
        $profile->save();
        return $profile;
    }

    public function changeMyPassword(Request $request)
    {
        $me = $this->getAdmin();

        if (!Hash::check($request->current_password, $me->user_password)) {
            $errors = new MessageBag();
            $errors->add('current_password', _e('validation::password'));
            return $errors;
        }

        User::where('user_id', $me->user_id)->update(['user_password' => Hash::make($request->password)]);

        event(new AfterChangeMyProfilePassword($me));
    }
}
