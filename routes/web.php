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
use Illuminate\Http\Request;
use App\Exports\FarmasiExport;
use App\Exports\ImprsExport;
use Maatwebsite\Excel\Facades\Excel;

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
    Route::get('/laporan-bulanan', [FarmasiController::class, 'laporanBulanan'])->name('farmasis.laporan-bulanan');

    Route::get('/laporan-bulanan/export', [FarmasiController::class, 'export'])->name('farmasis.laporan-bulanan.export');

    //farmasi imprs
    Route::resource('imprs', ImprsController::class);

    Route::get('/export', [ImprsController::class, 'laporanBulanan'])->name('imprs.export');
    Route::get('/export/export', [ImprsController::class, 'export'])->name('imprs.export.export');



});
