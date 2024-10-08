<?php

use App\Http\Controllers\PpiController;
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
use App\Http\Controllers\ApdController;
use App\Http\Controllers\AsesController;
use App\Http\Controllers\ClinicalController;
use App\Http\Controllers\DpjpController;
use App\Http\Controllers\EwsController;
use App\Http\Controllers\InterController;
use App\Http\Controllers\JatuhController;
use App\Http\Controllers\ListobatController;
use App\Http\Controllers\OkController;
use App\Http\Controllers\RajalController;
use App\Http\Controllers\RiController;
use App\Http\Controllers\RmrController;
use App\Http\Controllers\RmriController;
use App\Http\Controllers\VisiteController;
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


    //list obat
    Route::resource('list', ListobatController::class);
    // Route::get('list/show', [ListobatController::class, 'showImportForm']);
    // Route::post('list', [ListobatController::class, 'import'])->name('listobat.import');
    Route::post('/list/import', [ListobatController::class, 'import'])->name('list.index.import');
    Route::get('/autocomplete/nama_obat', [ListobatController::class, 'autocomplete']);


    //farmasi
    Route::resource('farmasis', FarmasiController::class);
    Route::get('/laporan-bulanan', [FarmasiController::class, 'laporanBulanan'])->name('farmasis.laporan-bulanan');
    Route::get('/laporan-bulanan/export', [FarmasiController::class, 'export'])->name('farmasis.laporan-bulanan.export');
    // Route::get('/farmasis', function () {
    //     $list = []; // Inisialisasi data $listobats
    //     return view('farmasis.create', compact('list'));
    // });

    //farmasi imprs
    Route::resource('imprs', ImprsController::class);

    Route::get('/export', [ImprsController::class, 'laporanBulanan'])->name('imprs.export');
    Route::get('/export/export', [ImprsController::class, 'export'])->name('imprs.export.export');

    //ok
    Route::resource('oks', OkController::class);
    Route::get('oks', [OkController::class, 'index'])->name('oks.index');
    Route::get('oks/create', [OkController::class, 'create'])->name('oks.create');
    Route::post('oks', [OkController::class, 'store'])->name('oks.store');
    Route::get('oks/{ok}', [OkController::class, 'show'])->name('oks.review');
    Route::get('oks/{ok}/edit', [OkController::class, 'edit'])->name('oks.edit');
    Route::put('oks/{ok}', [OkController::class, 'update'])->name('oks.update');
    Route::delete('oks/{ok}', [OkController::class, 'destroy'])->name('oks.destroy');
    Route::delete('/oks/delete/{id}', [RmrController::class, 'destroyId'])->name('oks.destroyId');
    Route::get('/oks/calendar', [OkController::class, 'calendar'])->name('oks.calendar');
    Route::get('/oks/review/{date}', [OkController::class, 'reviewByDate']);
    Route::get('/review_bulanan_ok', [OkController::class, 'reviewBulananOk'])->name('oks.review_bulanan_ok');
    Route::get('/review_bulanan_ok/export', [OkController::class, 'exportBulanan'])->name('oks.review_bulanan_ok.export');
    Route::get('/oks/check-data/{date}', [OkController::class, 'checkData']);
    //rm
    Route::resource('rmrs', RmrController::class);
    Route::get('rmrs', [RmrController::class, 'index'])->name('rmrs.index');
    Route::get('rmrs/create', [RmrController::class, 'create'])->name('rmrs.create');
    Route::post('rmrs', [RmrController::class, 'store'])->name('rmrs.store');
    Route::get('rmrs/{rmr}', [RmrController::class, 'show'])->name('rmrs.review');
    Route::get('rmrs/{rmr}/edit', [RmrController::class, 'edit'])->name('rmrs.edit');
    Route::put('rmrs/{rmr}', [RmrController::class, 'update'])->name('rmrs.update');
    Route::delete('rmrs/{rmr}', [RmrController::class, 'destroy'])->name('rmrs.destroy');
    Route::delete('/rmrs/delete/{id}', [RmrController::class, 'destroyId'])->name('rmrs.destroyId');
    Route::get('/rmrs/calendar', [RmrController::class, 'calendar'])->name('rmrs.calendar');
    Route::get('/rmrs/review/{date}', [RmrController::class, 'reviewRmByDate']);
    Route::get('/review_bulanan_rm', [RmrController::class, 'reviewBulananRm'])->name('rmrs.review_bulanan_rm');
    Route::get('/review_bulanan_rm/export', [RmrController::class, 'exportBulanan'])->name('rmrs.review_bulanan_rm.export');
    Route::get('/rmrs/check-data/{date}', [RmrController::class, 'checkData']);
    //rmri
    Route::resource('rmris', RmriController::class);
    Route::get('rmris', [RmriController::class, 'index'])->name('rmris.index');
    Route::get('rmris/create', [RmriController::class, 'create'])->name('rmris.create');
    Route::post('rmris', [RmriController::class, 'store'])->name('rmris.store');
    Route::get('rmris/{rmri}', [RmriController::class, 'show'])->name('rmris.review');
    Route::get('rmris/{rmri}/edit', [RmriController::class, 'edit'])->name('rmris.edit');
    Route::put('rmris/{rmri}', [RmriController::class, 'update'])->name('rmris.update');
    Route::delete('rmris/{rmri}', [RmriController::class, 'destroy'])->name('rmris.destroy');
    Route::delete('/rmris/delete/{id}', [RmriController::class, 'destroyId'])->name('rmris.destroyId');
    Route::get('/rmris/calendar', [RmriController::class, 'calendar'])->name('rmris.calendar');
    Route::get('/rmris/review/{date}', [RmriController::class, 'reviewRmiByDate']);
    Route::get('/review_bulanan_rmi', [RmriController::class, 'reviewBulananRmi'])->name('rmris.review_bulanan_rmi');
    Route::get('/review_bulanan_rmi/export', [RmriController::class, 'exportBulanan'])->name('rmris.review_bulanan_rmi.export');
    Route::get('/rmris/check-data/{date}', [RmriController::class, 'checkData']);

    //ppi
    Route::resource('ppis', PpiController::class);
    Route::get('/export_ppi', [PpiController::class, 'laporanBulanan'])->name('ppis.export_ppi');
    Route::get('/export_ppi/export', [PpiController::class, 'export'])->name('ppis.export_ppi.export');
    //ri
    Route::resource('ris', RiController::class);
    Route::get('/export_ri', [RiController::class, 'laporanBulanan'])->name('ris.export_ri');
    Route::get('/export_ri/export', [RiController::class, 'export'])->name('ris.export_ri.export');
    //visites
    Route::resource('visites', VisiteController::class);
    Route::get('/export_v', [VisiteController::class, 'laporanBulanan'])->name('visites.export_v');
    Route::get('/export_v/export', [VisiteController::class, 'export'])->name('visites.export_v.export');
    //clinicals
    Route::resource('clinicals', ClinicalController::class);
    Route::get('/export_c', [ClinicalController::class, 'laporanBulanan'])->name('clinicals.export_c');
    Route::get('/export_c/export', [ClinicalController::class, 'export'])->name('clinicals.export_c.export');
    //jatuhs
    Route::resource('jatuhs', JatuhController::class);
    Route::get('/export_j', [JatuhController::class, 'laporanBulanan'])->name('jatuhs.export_j');
    Route::get('/export_j/export', [JatuhController::class, 'export'])->name('jatuhs.export_j.export');
    //apds
    Route::resource('apds', ApdController::class);
    Route::get('/export_apd', [ApdController::class, 'laporanBulanan'])->name('apds.export_apd');
    Route::get('/export_apd/export', [ApdController::class, 'export'])->name('apds.export_apd.export');
    //ewss
    Route::resource('ewss', EwsController::class);
    Route::get('/export_e', [EwsController::class, 'laporanBulanan'])->name('ewss.export_e');
    Route::get('/export_e/export', [EwsController::class, 'export'])->name('ewss.export_e.export');
    //inters
    Route::resource('inters', InterController::class);
    Route::get('/export_in', [InterController::class, 'laporanBulanan'])->name('inters.export_in');
    Route::get('/export_in/export', [InterController::class, 'export'])->name('inters.export_in.export');
    //dpjps
    Route::resource('dpjps', DpjpController::class);
    Route::get('/export_dp', [DpjpController::class, 'laporanBulanan'])->name('dpjps.export_dp');
    Route::get('/export_dp/export', [DpjpController::class, 'export'])->name('dpjps.export_dp.export');
    //rajals
    Route::resource('rajals', RajalController::class);
    Route::get('/export_ra', [RajalController::class, 'laporanBulanan'])->name('rajals.export_ra');
    Route::get('/export_ra/export', [RajalController::class, 'export'])->name('rajals.export_ra.export');
    //asess
    Route::resource('asess', AsesController::class);
    Route::get('/export_as', [AsesController::class, 'laporanBulanan'])->name('asess.export_as');
    Route::get('/export_as/export', [AsesController::class, 'export'])->name('asess.export_as.export');
});
