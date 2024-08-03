<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\ImprsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MutuController;

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
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //permissions
    Route::resource('permissions', PermissionController::class)->only([
        'index'
    ]);

    //roles
    Route::resource('roles', RoleController::class)->except([
        'show'
    ]);

    //users
    Route::resource('users', UserController::class)->except([
        'show'
    ]);


    //farmasi
    Route::resource('farmasis', FarmasiController::class);
    //farmasi imprs
    Route::resource('imprs', ImprsController::class);

});
