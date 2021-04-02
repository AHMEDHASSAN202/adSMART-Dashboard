<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Repositories\AuthRepository;
use App\Http\Requests\Dashboard\LoginToDashboardRequest;

class DashboardAuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        $target = $request->query('target');

        return view('auth::dashboard-login', compact('target'));
    }

   public function submitLogin(LoginToDashboardRequest $loginToDashboardRequest)
   {
       $logged = $this->authRepository->loginToDashboard($loginToDashboardRequest);

       if (!$logged) {
           $errors = new MessageBag();
           $errors->add('email_or_password', true);
           return redirect()->back()->with(compact('errors'));
       }

       $target = $loginToDashboardRequest->query('target') ?? route('dashboard::dashboard');

       return redirect($target);
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
