<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    $str = '';
    $countries = \Illuminate\Support\Facades\DB::table('flags')->get();
    foreach ($countries as $country) {
        $str .= str_replace(['{', '}', ':'], ['[', ']', '=>'], json_encode($country)) . ', ';
    }
    dd($str);
    return view('welcome');
});
