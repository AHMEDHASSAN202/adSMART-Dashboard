<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Dashboard\ForgotPasswordRequest;
use App\Http\Requests\Dashboard\LoginToDashboardRequest;
use App\Http\Requests\Dashboard\ResetPasswordSubmit;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\MessageBag;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Str;

class DashboardAuthController extends AuthController
{
   public function submitLogin(LoginToDashboardRequest $loginToDashboardRequest)
   {
       $logged = $this->authRepository->loginToDashboard($loginToDashboardRequest);

       if ($logged instanceof MessageBag || !$logged) {
           return redirect()->back()->with(['errors' => $logged])->withInput();
       }

       return redirect($this->target ? url($this->target) : route('dashboard.index'));
   }

   public function logoutFromDashboard()
   {
       $logout = $this->authRepository->logoutFromDashboard();

       if (!$logout) {
           $errors = new MessageBag();
           $errors->add('invalid_logout', _e('invalid_logout'));
           return redirect()->back()->with(compact('errors'));
       }

       return redirect('/');
   }

    public function emailVerification(EmailVerificationRequest $emailVerificationRequest)
    {
        $emailVerificationRequest->fulfill();

        return redirect()->route('auth.dashboard.login')->with(['success' => _e('success_verify_msg')])->withInput(['email' => $emailVerificationRequest->user->user_email]);
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
}
