<?php

/**
 * Dashboard Auth Routes
 */

Route::group(['middleware' => ['guest']], function () {
    //dashboard login page
    Route::get('dashboard/login', 'DashboardAuthController@login')->name('auth::dashboard::login');
    //submit login to dashboard
    Route::post('dashboard/login', 'DashboardAuthController@submitLogin')->name('auth::dashboard::submitLogin');
});

Route::group(['middleware' => ['auth']], function () {
    //logout from dashboard
    Route::post('dashboard/logout', 'DashboardAuthController@logoutFromDashboard')->name('auth::dashboard::logout');
});
