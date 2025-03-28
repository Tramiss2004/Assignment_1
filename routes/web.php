<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ITAssetController;
use App\Http\Controllers\ITAssetLicenseDetailController;
use App\Http\Controllers\ITAssetMaintenanceController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\UserController;

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

// login page section 

Route::get('/LoginForStaff', function () {
    return view('LoginForStaff');
});

Route::get('/LoginForAdmin', function () {
    return view('LoginForAdministrator');
});

Route::view('MenuForAdmin', 'MenuForAdmin');
Route::view('MenuForStaff', 'MenuForStaff');

//IT_Asset page
Route::get('/it_asset', [ITAssetController::class, 'index'])->name('it_assets.index');

//view IT_Asset details page
Route::get('/it_asset/{id}', [ITAssetController::class, 'show'])->name('it_assets.show');

//edit or update the IT_Asset
Route::get('/it_asset/{id}/edit', [ITAssetController::class, 'edit'])->name('it_assets.edit'); // Show edit form
Route::put('/it_asset/{id}', [ITAssetController::class, 'update'])->name('it_assets.update');  // Handle form submission

//delete
Route::delete('/it_asset/{id}', [ITAssetController::class, 'destroy'])->name('it_assets.destroy');

//create new it asset
// Show the form to create a new IT asset
Route::get('/it_asset/create', [ITAssetController::class, 'create'])->name('it_assets.create');

// Handle form submission to store the new asset
Route::post('/it_asset', [ITAssetController::class, 'store'])->name('it_assets.store');

// Profile Page 

Route::get('/ProfilePage/{id}', [UserController::class, 'showData']);

// It asset details page 

Route::get('/it_asset/{id}', [ITAssetController::class, 'show']);
