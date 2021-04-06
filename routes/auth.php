<?php

/**
 * Dashboard Auth Routes
 */

Route::group(['middleware' => ['guest:dashboard']], function () {
    //dashboard login page
    Route::get('dashboard/login', 'DashboardAuthController@loginPage')->name('auth.dashboard.login');
    //submit login to dashboard
    Route::post('dashboard/login', 'DashboardAuthController@submitLogin')->name('auth.dashboard.submitLogin');

    //verify mail
    Route::get('dashboard/email-verify/{id}/{hash}', 'DashboardAuthController@emailVerification')->middleware(['signed'])->name('auth.dashboard.verification.verify');

    //reset password
    Route::get('dashboard/forgot-password', 'DashboardAuthController@forgotPasswordRequest')->name('auth.dashboard.password.request');
    Route::post('dashboard/forgot-password', 'DashboardAuthController@forgotPasswordRequestSubmit')->name('auth.dashboard.password.request.submit');
    Route::get('dashboard/reset-password/{token}', 'DashboardAuthController@forgotPasswordResetForm')->name('auth.dashboard.password.reset.form');
    Route::post('dashboard/reset-password', 'DashboardAuthController@forgotPasswordResetSubmit')->name('auth.dashboard.password.reset.submit');
});

Route::group(['middleware' => ['auth:dashboard']], function () {
    //logout from dashboard
    Route::post('dashboard/logout', 'DashboardAuthController@logoutFromDashboard')->name('auth.dashboard.logout');
});
