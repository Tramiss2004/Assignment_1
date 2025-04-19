<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::post('/LoginForStaff', [UserController::class, 'login']);

Route::get('/LoginForAdmin', function () {
    return view('LoginForAdministrator');
});

Route::post('/LoginForAdmin', [UserController::class, 'login']);

Auth::routes();

Route::get('/Menu', function(){
    return view('Menu');
})->middleware('auth');


// logout function part
Route::get('logout', function(){
    if(session() -> has('user')){
        session()->pull('user');
    }
    return redirect('MainPage');
});


//IT_Asset page
Route::get('/it_asset', [ITAssetController::class, 'index'])->name('it_assets.index');

//view IT_Asset details page
Route::get('/it_asset/{id}', [ITAssetController::class, 'show'])->name('it_assets.show');
Route::resource('it_assets', ITAssetController::class);


//edit or update the IT_Asset
Route::get('/it_asset/{id}/edit', [ITAssetController::class, 'edit'])->name('it_assets.edit'); // Show edit form
Route::put('/it_asset/{id}', [ITAssetController::class, 'update'])->name('it_assets.update');  // Handle form submission

//delete
Route::delete('/it_asset/{id}', [ITAssetController::class, 'destroy'])->name('it_assets.destroy');

//create new it asset
// Show the form to create a new IT asset
Route::get('/it_assets/create', [ITAssetController::class, 'create'])->name('it_assets.create');

Route::post('/it_assets', [ITAssetController::class, 'store'])->name('it_assets.store');




// Profile Page

Route::get('/ProfilePage/{id}', [UserController::class, 'showData']);

// IT Asset Maintenance Page
Route::get('/it_asset_maintenance/asset/{assetId}', [ITAssetMaintenanceController::class, 'showByAsset']);

// IT Asset CRUD
Route::get('/it_asset_maintenance/edit/{id}', [ITAssetMaintenanceController::class, 'edit']);
Route::put('/it_asset_maintenance/update/{id}', [ITAssetMaintenanceController::class, 'update']);

Route::delete('/it_asset_maintenance/delete/{id}', [ITAssetMaintenanceController::class, 'destroy']);

// User List 
Route::get('/user_list', [UserController::class, 'index'])->name('user_list.index');

//view User details page
Route::get('/user_list/{id}', [UserController::class, 'show'])->name('user_list.show');
Route::resource('user_list', UserController::class);


//edit or update the User
Route::get('/user_list/{id}/edit', [UserController::class, 'edit'])->name('user_list.edit'); // Show edit form
Route::put('/user_list/{id}', [UserController::class, 'update'])->name('user_list.update');  // Handle form submission

//delete
Route::delete('/user_list/{id}', [UserController::class, 'destroy'])->name('user_list.destroy');

//create new it asset
// Show the form to create a new IT asset
Route::get('/user_list/create', [UserController::class, 'create'])->name('user_list.create');

Route::post('/user_list', [UserController::class, 'store'])->name('user_list.store');

// Licenses 
Route::resource('licenses', LicenseController::class);
