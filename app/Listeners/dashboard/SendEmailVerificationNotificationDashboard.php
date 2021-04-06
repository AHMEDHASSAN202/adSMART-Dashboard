<?php

namespace App\Listeners\Dashboard;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class SendEmailVerificationNotificationDashboard
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
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
            $event->user->sendEmailVerificationNotification();
            $errors = new MessageBag();
            $errors->add('need_verify_email', _e('need_verify_email_msg'));
            abort(redirect()->route('auth.dashboard.login')->withInput(['email'])->withErrors($errors));
        }
    }
}
