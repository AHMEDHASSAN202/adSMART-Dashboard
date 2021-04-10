<?php

/**
 * Dashboard Auth Routes
 */

Route::group(['middleware' => ['guest:dashboard']], function () {
    //dashboard login page
    Route::get('dashboard/login', 'DashboardAuthController@loginPage')->name('auth.dashboard.login');
    //submit login to dashboard
    Route::post('dashboard/login', 'DashboardAuthController@submitLogin')->name('auth.dashboard.submitLogin');

    //reset password
    Route::get('dashboard/forgot-password', 'DashboardAuthController@forgotPasswordRequest')->name('auth.dashboard.password.request');
    Route::post('dashboard/forgot-password', 'DashboardAuthController@forgotPasswordRequestSubmit')->name('auth.dashboard.password.request.submit');
    Route::get('dashboard/reset-password/{token}', 'DashboardAuthController@forgotPasswordResetForm')->name('auth.dashboard.password.reset.form');
    Route::post('dashboard/reset-password', 'DashboardAuthController@forgotPasswordResetSubmit')->name('auth.dashboard.password.reset.submit');
});

//verify mail
Route::get('dashboard/email-verify/{id}/{hash}', 'DashboardAuthController@emailVerification')->middleware(['signed'])->name('auth.dashboard.verification.verify');

Route::group(['middleware' => ['auth:dashboard', 'dashboard.inertia.request']], function () {
    //resending the verification email
    Route::post('dashboard/verification-notification', 'DashboardAuthController@verificationNotification')->middleware('throttle:3,1')->name('auth.dashboard.verification.notification');
    //logout from dashboard
    Route::post('dashboard/logout', 'DashboardAuthController@logoutFromDashboard')->name('auth.dashboard.logout');
    //profile
    Route::get('dashboard/profile', 'DashboardAuthController@getProfile')->name('auth.dashboard.profile');
    Route::post('dashboard/profile/logout-other-devices', 'DashboardAuthController@logoutFromOtherDevices')->name('auth.dashboard.profile.logout.other.devices');
    Route::put('dashboard/profile/info', 'DashboardAuthController@updateProfileInfo')->name('auth.dashboard.profile.info.update');
    Route::put('dashboard/profile/personal-options', 'DashboardAuthController@updatePersonalOptions')->name('auth.dashboard.personal.options.update');
    Route::put('dashboard/profile/change-password', 'DashboardAuthController@changeMyPassword')->name('auth.dashboard.profile.change.password');
});
