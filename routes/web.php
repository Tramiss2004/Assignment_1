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
    return view('MainPage');
});


Route::get('/LoginForStaff', function () {
    return view('LoginForStaff');
});

Route::get('/LoginForAdmin', function () {
    return view('LoginForAdministrator');
});