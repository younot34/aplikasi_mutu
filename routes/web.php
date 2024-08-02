<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmasiController;
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

    //mutu
    Route::resource('mutus', MutuController::class);
    Route::get('/mutus/result/{score}/{user_id}/{mutu_id}', [MutuController::class, 'result'])->name('mutus.result');
    Route::get('/mutus/start/{id}', [MutuController::class, 'start'])->name('mutus.start');
    Route::get('mutus/karyawan/{id}', [MutuController::class, 'karyawan'])->name('mutus.karyawan');
    Route::put('mutus/assign/{id}', [MutuController::class, 'assign'])->name('mutus.assign');
    Route::get('/mutus/review/{user_id}/{mutu_id}', [MutuController::class, 'review'])->name('mutus.review');
});
