<?php

/**
 * Dashboard Auth Routes
 */

Route::group(['middleware' => ['guest:dashboard']], function () {
    //dashboard login page
    Route::get('dashboard/login', 'DashboardAuthController@loginPage')->name('auth.dashboard.login');
    //submit login to dashboard
    Route::post('dashboard/login', 'DashboardAuthController@submitLogin')->name('auth.dashboard.submitLogin');
});

Route::group(['middleware' => ['auth:dashboard']], function () {
    //logout from dashboard
    Route::post('dashboard/logout', 'DashboardAuthController@logoutFromDashboard')->name('auth.dashboard.logout');
});
