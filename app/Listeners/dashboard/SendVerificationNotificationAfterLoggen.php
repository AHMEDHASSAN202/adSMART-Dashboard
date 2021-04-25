<?php

namespace App\Listeners\Dashboard;

use App\Repositories\AuthRepository;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\MessageBag;


class SendVerificationNotificationAfterLoggen
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
        if (!((boolean)getOptionValue('users_must_verify_email'))) {
            return;
        }
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            app(AuthRepository::class)->sendVerifyEmail($event->user);
            $errors = new MessageBag();
            $errors->add('need_verify_email', _e('need_verify_email_msg'));
            abort(redirect()->route('auth.dashboard.login')->withInput(['email'])->withErrors($errors));
        }
    }
}
