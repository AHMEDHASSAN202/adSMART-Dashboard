<?php

namespace App\Http\Middleware\Dashboard;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleDashboardInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'dashboard.dashboard';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $user = app(AuthRepository::class)->getAdmin();

        $userVerified = $user->hasVerifiedEmail();
        $d = null;
        if (!$userVerified && ((boolean)getOptionValue('display_must_verify_email_msg'))) {
            $d = makeAlert('warning', _e('must_verify_email_msg'), 'flaticon-warning-sign')['alert'];
            $d['with_resend_verification_link'] = true;
        }

        return array_merge(parent::share($request), [
            'alert'             => $request->session()->get('alert') ?? $d,
            'auth'              => $user,
            'auth_verified'     => $userVerified,
            'queries'     =>    $request->query() ? $request->query() : new \stdClass(),
        ]);
    }
}
