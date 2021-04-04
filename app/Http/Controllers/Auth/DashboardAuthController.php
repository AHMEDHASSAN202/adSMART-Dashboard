<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\MessageBag;
use App\Http\Requests\Dashboard\LoginToDashboardRequest;

class DashboardAuthController extends AuthController
{
   public function submitLogin(LoginToDashboardRequest $loginToDashboardRequest)
   {
       $logged = $this->authRepository->loginToDashboard($loginToDashboardRequest);

       if (!$logged) {
           $errors = new MessageBag();
           $errors->add('email_or_password', true);
           return redirect()->back()->with(compact('errors'))->withInput();
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

}
