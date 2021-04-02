<?php
/**
 * Dashboard Routes
 * All Routes Under "dashboard" Prefix
 * All Routes Under "auth" Middleware
 */

Route::get('about', function () {
    return \Inertia\Inertia::render('About');
});

//dashboard routes
Route::get('', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);

//localization routes
Route::group(['prefix' => 'localization'], function () {
    Route::get('languages', ['uses' => 'LanguagesController@index', 'as' => 'dashboard.languages.index']);
    Route::get('languages/create', ['uses' => 'LanguagesController@create', 'as' => 'dashboard.languages.create']);
    Route::post('languages', ['uses' => 'LanguagesController@store', 'as' => 'dashboard.languages.store']);
    Route::get('languages/{languageId}/edit', ['uses' => 'LanguagesController@edit', 'as' => 'dashboard.languages.edit']);
    Route::put('languages/{language}', ['uses' => 'LanguagesController@update', 'as' => 'dashboard.languages.update']);
    Route::put('languages/{language}/display-front', ['uses' => 'LanguagesController@toggleDisplayFront', 'as' => 'dashboard.languages.toggle_display_front']);
    Route::delete('languages', ['uses' => 'LanguagesController@destroy', 'as' => 'dashboard.languages.destroy']);
    Route::get('translations', ['uses' => 'TranslationsController@index', 'as' => 'dashboard.translations.index']);
    Route::put('translations', ['uses' => 'TranslationsController@updateTranslate', 'as' => 'dashboard.translations.update']);
});


//roles routes
Route::group(['prefix' => 'roles'], function () {
    Route::get('/', ['uses' => 'RolesController@index', 'as' => 'roles.index']);
    Route::post('/', ['uses' => 'RolesController@addRole', 'as' => 'roles.add_role']);
    Route::put('/{role}', ['uses' => 'RolesController@updateRole', 'as' => 'roles.update_role']);
    Route::delete('/', ['uses' => 'RolesController@deleteRole', 'as' => 'roles.delete_role']);
});


//settings routes
Route::group(['prefix' => 'settings'], function () {
    Route::get('', ['uses' => 'SettingsController@index', 'as' => 'settings.index']);
    Route::put('cache/clear', ['uses' => 'CacheController@clearCache', 'as' => 'settings.cache.clear']);
});
