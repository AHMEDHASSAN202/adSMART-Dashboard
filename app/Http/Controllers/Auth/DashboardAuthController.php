<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Dashboard\ChangeMyPasswordRequest;
use App\Http\Requests\Dashboard\ForgotPasswordRequest;
use App\Http\Requests\Dashboard\LoginToDashboardRequest;
use App\Http\Requests\Dashboard\ResetPasswordSubmit;
use App\Http\Requests\Dashboard\UpdatePersonalOptionsRequest;
use App\Http\Requests\Dashboard\UpdateProfileInfoDashboardRequest;
use App\Models\ActivityLog;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\MessageBag;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;

class DashboardAuthController extends AuthController
{
   public function submitLogin(LoginToDashboardRequest $loginToDashboardRequest)
   {
       $logged = $this->authRepository->loginToDashboard($loginToDashboardRequest);

       if ($logged instanceof MessageBag || !$logged) return redirect()->back()->withErrors($logged)->withInput();

       return redirect($this->target ? url($this->target) : route('dashboard.index'));
   }

   public function logoutFromDashboard()
   {
       $logout = $this->authRepository->logoutFromDashboard();

       if (!$logout) {
           $errors = new MessageBag();
           $errors->add('invalid_logout', _e('invalid_logout'));
           return redirect()->back()->withErrors($errors);
       }

       return redirect('/');
   }

    public function emailVerification(EmailVerificationRequest $emailVerificationRequest)
    {
        $emailVerificationRequest->fulfill();

        if ($this->authRepository->isUserLoggedToDashboard($emailVerificationRequest->user)) {
            return redirect()->route('dashboard.index')->with(makeAlert('info', _e('success_verify_msg'), 'flaticon-like'));
        }

        return redirect('/');
    }

    public function verificationNotification()
    {
        $this->authRepository->sendVerifyEmail($this->authRepository->getAdmin());

        return redirect()->back()->with(alertFromStatus(true));
    }

    public function forgotPasswordRequest()
    {
        return view('dashboard.auth.forgot-password-request');
    }

    public function forgotPasswordRequestSubmit(ForgotPasswordRequest $forgotPasswordRequest)
    {
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return route('auth.dashboard.password.reset.form', compact('token'));
        });
        $status = Password::sendResetLink(['user_email' => $forgotPasswordRequest->email]);

        return ($status === Password::RESET_LINK_SENT) ?
                           back()->with(['success' => _e('reset_link_sent_msg')]) :
                           back()->withErrors(['email' => _e('error_message')]);
    }

    public function forgotPasswordResetForm($token)
    {
        return view('dashboard.auth.forgot-password-reset-form', compact('token'));
    }

    public function forgotPasswordResetSubmit(ResetPasswordSubmit $resetPasswordSubmit)
    {
        $status = Password::reset(
            $resetPasswordSubmit->only('password', 'password_confirmation', 'token') + ['user_email' => $resetPasswordSubmit['email']],
            function ($user, $password) use ($resetPasswordSubmit) {
                $user->forceFill(['user_password' => Hash::make($password)])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ?
                           redirect()->route('auth.dashboard.login')->with(['success' => _e('reset_link_success_msg')]) :
                           back()->withErrors(['email' => _e('error_message')]);
    }

    public function getProfile(Request $request)
    {
        $profile = $this->authRepository->getProfileAdmin();
        $activities = ActivityLog::getActivityLogsAuth($profile->user_id);
        $myActivities = collect([]);
        $loggedActivities = collect([]);
        foreach ($activities as $activity) {
            if ($activity->user_activity != 'dashboard_logged') {
                $myActivities->push($activity);
            }else {
                $activity->currentDevice = ($activity->ip_address === $request->ip());
                $loggedActivities->push($activity);
            }
        }
        $flags = getFlags();

        return Inertia::render('Profile/Index', compact('profile','myActivities', 'loggedActivities', 'flags'));
    }

    public function logoutFromOtherDevices(Request $request)
    {
        $validatedData = $request->validate(['currentPassword' => 'required'], ['required' => _e('validation::required')], ['currentPassword' => _e('current_password')]);

        $r = $this->authRepository->logoutOtherDevices($validatedData['currentPassword']);

        if ($r instanceof MessageBag) return redirect()->back()->with('errors', $r)->withErrors($r);

        return redirect()->route('auth.dashboard.profile')->with(alertFromStatus(true));
    }

    public function updateProfileInfo(UpdateProfileInfoDashboardRequest $infoDashboardRequest)
    {
        $this->authRepository->updateProfileInfo($infoDashboardRequest);

        return redirect()->back()->with(alertFromStatus(true));
    }

    public function updatePersonalOptions(UpdatePersonalOptionsRequest $updatePersonalOptions)
    {
        $this->authRepository->updatePersonalOptions($updatePersonalOptions);

        return redirect()->back()->with(alertFromStatus(true));
    }

    public function changeMyPassword(ChangeMyPasswordRequest $changeMyPasswordRequest)
    {
        $result = $this->authRepository->changeMyPassword($changeMyPasswordRequest);

        if ($result instanceof MessageBag) return redirect()->back()->withErrors($result);

        return redirect()->back()->with(alertFromStatus(true));
    }

    public function deleteAccount(Request $request)
    {
        $validatedData = $request->validate(['currentPassword' => 'required'], ['required' => _e('validation::required')], ['currentPassword' => _e('current_password')]);

        $result = $this->authRepository->deleteMyAccount($validatedData['currentPassword']);

        if ($result instanceof MessageBag) return redirect()->back()->withErrors($result);

        return Inertia::location(url(''));
    }
}
