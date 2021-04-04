<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Dashboard\LoginToDashboardRequest;
use Illuminate\Support\MessageBag;
use App\Http\Requests\EmailVerificationRequest;

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

}
