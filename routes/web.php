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



// IT Asset Maintenance Page
Route::get('/it_asset_maintenance/asset/{assetId}', [ITAssetMaintenanceController::class, 'showByAsset']);

Route::get('/ViewMaintenanceList', [ITAssetMaintenanceController::class, 'showList'])->name('ViewMaintenanceList');
Route::get('/it_asset_maintenance/{id}', [ITAssetMaintenanceController::class, 'show'])->name('it_asset_maintenance.show');

// IT Asset Maintenance Creation
Route::get('/CreateMaintenanceView', [ITAssetMaintenanceController::class, 'create'])->name('it_assetMaintenances.create');
Route::post('/it_asset_maintenance', [ITAssetMaintenanceController::class, 'store'])->name('it_assetMaintenances.store');

// IT Asset CRUD
Route::get('/it_asset_maintenance/edit/{id}', [ITAssetMaintenanceController::class, 'edit']);
Route::put('/it_asset_maintenance/update/{id}', [ITAssetMaintenanceController::class, 'update']);

Route::delete('/it_asset_maintenance/delete/{id}', [ITAssetMaintenanceController::class, 'destroy']);

Route::get('/it_asset_maintenance/create', [ITAssetMaintenanceController::class, 'create'])->name('it_asset_maintenance.create');
Route::post('/it_asset_maintenance/store', [ITAssetMaintenanceController::class, 'store'])->name('it_asset_maintenance.store');

// User List
Route::get('/user_list', [UserController::class, 'index'])->name('user_list.index');

//view User details page
Route::get('/user_list/{id}', [UserController::class, 'show'])->name('user_list.show');

//edit or update the User
Route::get('/user_list/{id}/edit', [UserController::class, 'edit'])->name('user_list.edit'); // Show edit form
Route::put('/user_list/{id}', [UserController::class, 'update'])->name('user_list.update');  // Handle form submission

//delete
Route::delete('/user_list/{id}', [UserController::class, 'destroy'])->name('user_list.destroy');

//create new user
// Show the form to create a new User
Route::get('/user_lists/create', [UserController::class, 'create'])->name('user_list.create');

Route::post('/user_lists', [UserController::class, 'store'])->name('user_list.store');

// Profile Page
Route::get('/ProfilePage/{id}', [UserController::class, 'showData']);



// Licenses 
Route::get('/license_list', [LicenseController::class, 'index'])->name('license.index');

//view User details page
Route::get('/license/{id}', [LicenseController::class, 'show'])->name('license.show');

//edit or update the User
Route::get('/license/{id}/edit', [LicenseController::class, 'edit'])->name('license.edit'); // Show edit form
Route::put('/license/{id}', [LicenseController::class, 'update'])->name('license.update');  // Handle form submission

//delete
Route::delete('/license/{id}', [LicenseController::class, 'destroy'])->name('license.destroy');

//create new user
// Show the form to create a new User
Route::get('/licenses/create', [LicenseController::class, 'create'])->name('license.create');

Route::post('/licenses', [LicenseController::class, 'store'])->name('license.store');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


