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

<<<<<<< HEAD
Route::view('Menu', 'Menu')->name('Menu');

// logout function part
Route::get('logout', function(){
    if(session() -> has('user')){
        session()->pull('user');
    }
    return redirect('MainPage');
});
=======
Route::view('MenuForAdmin', 'MenuForAdmin');
Route::view('MenuForStaff', 'MenuForStaff');
>>>>>>> b28a1d1c065fb735b6b7389dd86e8492fabd9e40

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

<<<<<<< HEAD
// Profile Page
=======


// Profile Page 
>>>>>>> b28a1d1c065fb735b6b7389dd86e8492fabd9e40

Route::get('/ProfilePage/{id}', [UserController::class, 'showData']);

// It asset details page

Route::get('/it_asset/{id}', [ITAssetController::class, 'show']);
<<<<<<< HEAD

// User List


// Licenses
Route::resource('licenses', LicenseController::class);

// User List


// Licenses
Route::resource('licenses', LicenseController::class);
=======
>>>>>>> b28a1d1c065fb735b6b7389dd86e8492fabd9e40
