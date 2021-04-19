<?php
/**
 * Dashboard Routes
 * All Routes Under "dashboard" Prefix
 * All Routes Under "auth" Middleware
 */

//dashboard routes
Route::get('', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index'])->middleware('permissions:dashboard-browse');

//images
Route::post('dashboard/tiny-editor-images/{module}', ['uses' => 'ImageController@uploadImage', 'as' => 'dashboard.images.uploaded']);


//localization routes
Route::group(['prefix' => 'localization'], function () {
    Route::get('languages', ['uses' => 'LanguagesController@index', 'as' => 'dashboard.languages.index'])->middleware('permissions:localization-browse');
    Route::get('languages/create', ['uses' => 'LanguagesController@create', 'as' => 'dashboard.languages.create'])->middleware('permissions:localization-create');
    Route::post('languages', ['uses' => 'LanguagesController@store', 'as' => 'dashboard.languages.store'])->middleware('permissions:localization-create');
    Route::get('languages/{languageId}/edit', ['uses' => 'LanguagesController@edit', 'as' => 'dashboard.languages.edit'])->middleware('permissions:localization-update');
    Route::put('languages/{language}', ['uses' => 'LanguagesController@update', 'as' => 'dashboard.languages.update'])->middleware('permissions:localization-update');
    Route::put('languages/{language}/display-front', ['uses' => 'LanguagesController@toggleDisplayFront', 'as' => 'dashboard.languages.toggle_display_front'])->middleware('permissions:localization-update');
    Route::delete('languages', ['uses' => 'LanguagesController@destroy', 'as' => 'dashboard.languages.destroy'])->middleware('permissions:localization-delete');
    Route::get('translations', ['uses' => 'TranslationsController@index', 'as' => 'dashboard.translations.index'])->middleware('permissions:localization-browse');
    Route::put('translations', ['uses' => 'TranslationsController@updateTranslate', 'as' => 'dashboard.translations.update'])->middleware('permissions:localization-update');
});


//roles routes
Route::group(['prefix' => 'roles'], function () {
    Route::get('', ['uses' => 'RolesController@index', 'as' => 'dashboard.roles.index'])->middleware('permissions:roles-browse');
    Route::post('', ['uses' => 'RolesController@store', 'as' => 'dashboard.roles.store'])->middleware('permissions:roles-create');
    Route::get('create', ['uses' => 'RolesController@create', 'as' => 'dashboard.roles.create'])->middleware('permissions:roles-create');
    Route::get('{role}/edit', ['uses' => 'RolesController@edit', 'as' => 'dashboard.roles.edit'])->middleware('permissions:roles-update');
    Route::put('{role}', ['uses' => 'RolesController@update', 'as' => 'dashboard.roles.update'])->middleware('permissions:roles-update');
    Route::delete('', ['uses' => 'RolesController@destroy', 'as' => 'dashboard.roles.destroy'])->middleware('permissions:roles-delete');
});


//settings routes
Route::group(['prefix' => 'settings'], function () {
    Route::get('', ['uses' => 'SettingsController@index', 'as' => 'dashboard.settings.index'])->middleware('permissions:settings-browse');
    Route::put('general-data', ['uses' => 'SettingsController@updateGeneralData', 'as' => 'dashboard.settings.general.data.update'])->middleware('permissions:settings-update');
    Route::put('contactus-data', ['uses' => 'SettingsController@updateContactUsData', 'as' => 'dashboard.settings.contactus.data.update'])->middleware('permissions:settings-update');
    Route::put('dashboard-data', ['uses' => 'SettingsController@updateDashboardData', 'as' => 'dashboard.settings.dashboard.data.update'])->middleware('permissions:settings-update');
//    Route::put('cache/clear', ['uses' => 'CacheController@clearCache', 'as' => 'settings.cache.clear']);
});


//users routes
Route::group(['prefix' => 'users'], function () {
    Route::get('', ['uses' => 'UsersController@index', 'as' => 'dashboard.users.index'])->middleware('permissions:users-browse');
    Route::get('create', ['uses' => 'UsersController@create', 'as' => 'dashboard.users.create'])->middleware('permissions:users-create');
    Route::post('', ['uses' => 'UsersController@store', 'as' => 'dashboard.users.store'])->middleware('permissions:users-create');
    Route::get('{user}', ['uses' => 'UsersController@edit', 'as' => 'dashboard.users.edit'])->middleware('permissions:users-update');
    Route::put('{user}', ['uses' => 'UsersController@update', 'as' => 'dashboard.users.update'])->middleware('permissions:users-update');
    Route::delete('', ['uses' => 'UsersController@destroy', 'as' => 'dashboard.users.destroy'])->middleware('permissions:users-delete');
});


//pages routes
Route::group(['prefix' => 'pages'], function () {
    Route::get('', ['uses' => 'PagesController@index', 'as' => 'dashboard.pages.index'])->middleware('permissions:pages-browse');
    Route::get('create', ['uses' => 'PagesController@create', 'as' => 'dashboard.pages.create'])->middleware('permissions:pages-create');
    Route::post('', ['uses' => 'PagesController@store', 'as' => 'dashboard.pages.store'])->middleware('permissions:pages-create');
    Route::get('{page_id}', ['uses' => 'PagesController@edit', 'as' => 'dashboard.pages.edit'])->middleware('permissions:pages-update');
    Route::put('{page_id}', ['uses' => 'PagesController@update', 'as' => 'dashboard.pages.update'])->middleware('permissions:pages-update');
    Route::delete('', ['uses' => 'PagesController@destroy', 'as' => 'dashboard.pages.destroy'])->middleware('permissions:pages-delete');
});


//types routes
Route::group(['prefix' => 'types'], function () {
    Route::get('{type_key}', ['uses' => 'TypesController@index', 'as' => 'dashboard.types.index'])->middleware('permissions:types-browse');
    Route::post('', ['uses' => 'TypesController@store', 'as' => 'dashboard.types.store'])->middleware('permissions:types-create');
    Route::put('{type_id}', ['uses' => 'TypesController@update', 'as' => 'dashboard.types.update'])->middleware('permissions:types-update');
    Route::delete('', ['uses' => 'TypesController@destroy', 'as' => 'dashboard.types.destroy'])->middleware('permissions:types-delete');
});


//categories routes
Route::group(['prefix' => 'categories'], function () {
    Route::get('', ['uses' => 'CategoriesController@index', 'as' => 'dashboard.categories.index'])->middleware('permissions:categories-browse');
    Route::get('create', ['uses' => 'CategoriesController@create', 'as' => 'dashboard.categories.create'])->middleware('permissions:categories-create');
    Route::post('', ['uses' => 'CategoriesController@store', 'as' => 'dashboard.categories.store'])->middleware('permissions:categories-create');
    Route::put('sort', ['uses' => 'CategoriesController@sort', 'as' => 'dashboard.categories.sort'])->middleware('permissions:categories-update');
    Route::get('{category_id}', ['uses' => 'CategoriesController@edit', 'as' => 'dashboard.categories.edit'])->middleware('permissions:categories-update');
    Route::put('{category_id}', ['uses' => 'CategoriesController@update', 'as' => 'dashboard.categories.update'])->middleware('permissions:categories-update');
    Route::delete('', ['uses' => 'CategoriesController@destroy', 'as' => 'dashboard.categories.destroy'])->middleware('permissions:categories-delete');
});
