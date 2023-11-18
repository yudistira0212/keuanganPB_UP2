<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ArspmlsController;
use App\Http\Controllers\ArspplsController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\SP2DController;
use App\Http\Controllers\Sp2dsController;
use App\Http\Controllers\SPMController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\Arsp2dController;
use App\Http\Controllers\ArspmController;
use App\Http\Controllers\ArspmallController;
use App\Http\Controllers\ArspmguController;
use App\Http\Controllers\ArspmtuController;
use App\Http\Controllers\ArspmupController;
use App\Http\Controllers\ArsppController;
use App\Http\Controllers\ArspptupController;
use App\Http\Controllers\ArsppupController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PermintaanSp2dController;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

// Route::group(['prefix'=>'Home'], function(){
Route::middleware(['auth'])->prefix('Home')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('Home');

    //Hak Akses Super User
    Route::get('/Admin/Users', [AdministratorController::class, 'index'])->name('Administrator')->middleware('userAkses:superuser');
    Route::get('/Admin/Users/Create', [AdministratorController::class, 'create'])->name('create-user')->middleware('userAkses:superuser');
    Route::post('/Admin/Users/Create', [AdministratorController::class, 'createUser'])->name('create-user-store')->middleware('userAkses:superuser');

    Route::get('/Keuangan/SP2D', [Sp2dsController::class, 'index'])->name('SP2D')->middleware('userAkses:keuangan');
    Route::get('/Keuangan/SP2D/Create', [Sp2dsController::class, 'create'])->name('create-sp2d')->middleware('userAkses:keuangan');
    Route::get('/Keuangan/SP2D/edit/{id}', [Sp2dsController::class, 'editView'])->name('edit-sp2d-view')->middleware('userAkses:keuangan');
    // Route::post('/Keuangan/SP2D/Create', [Sp2dsController::class, 'create'])->name('create-sp2d')->middleware('userAkses:keuangan');
    Route::post('/Keuangan/SP2D/Store', [Sp2dsController::class, 'store'])->name('store-sp2d')->middleware('userAkses:keuangan');
    Route::patch('/Keuangan/SP2D/update/{id}', [Sp2dsController::class, 'update'])->name('update-sp2d')/* ->middleware('userAkses:keuangan'); */;
    Route::delete('/Keuangan/SP2D/delete/{id}', [Sp2dsController::class, 'delete'])->name('delete-sp2d')->middleware('userAkses:keuangan');
    Route::get('/Keuangan/SP2D/Create/add-column', [Sp2dsController::class, 'addColumn'])->name('addcolumn')->middleware('userAkses:keuangan');
    Route::post('/Keuangan/SP2D/Create/simpan-keperluan', [Sp2dsController::class, 'simpanKeperluan'])->name('save-keperluan')->middleware('userAkses:keuangan');
    Route::post('/Keuangan/SP2D/Create/simpan-potongan', [Sp2dsController::class, 'simpanPotongan'])->name('save-potongan')->middleware('userAkses:keuangan');
    Route::get('/Keuangan/SP2D-view/{sp2d}', [Sp2dsController::class, 'view'])->name('SP2D-view')/* ->middleware('userAkses:keuangan') */;


    Route::get('/Keuangan/SP2D/Buat-Permintaan', [PermintaanSp2dController::class, 'form'])->name('Form-Permintaan-SP2D')/* middleware('userAkses:keuangan') */;
    Route::get('/Keuangan/SP2D/List-Permintaan', [PermintaanSp2dController::class, 'list'])->name('listPermintaanSP2D')/* ->middleware('userAkses:keuangan') */;
    Route::get('/Keuangan/SP2D/List-Permintaan/download/{id}', [PermintaanSp2dController::class, 'downloadFile'])->name('listPermintaanSP2D-download')/* ->middleware('userAkses:keuangan') */;
    Route::post('/Keuangan/SP2D/Permintaan/store', [PermintaanSp2dController::class, 'store'])->name('PermintaanSP2D-store')/* ->middleware('userAkses:keuangan') */;
    Route::patch('/Keuangan/SP2D/Permintaan/{id}/{status}', [PermintaanSp2dController::class, 'updateStatus'])->name('PermintaanSP2D-updateStatus')/* ->middleware('userAkses:keuangan') */;

    // SKPD

    Route::get('/Admin/skpd', [SkpdController::class, 'index'])->name('skpd-view');
    Route::get('/Admin/skpd/create', [SkpdController::class, 'create'])->name('skpd-crete');
    Route::get('/Admin/skpd/edit/{id}', [SkpdController::class, 'edit'])->name('skpd-edit');
    Route::post('/Admin/skpd/store', [SkpdController::class, 'store'])->name('skpd-store');
    Route::patch('/Admin/skpd/update/{id}', [SkpdController::class, 'update'])->name('skpd-update');

    //Arsip
    Route::get('/Admin/Arsip-Lainnya', [ArsipController::class, 'index'])->name('lain')/* ->middleware('userAkses:superuser') */;
    Route::get('/Admin/Arsip-Lainnya/Upload', [ArsipController::class, 'create'])->name('up-create')/* ->middleware('userAkses:superuser') */;

    //Arsip SP2D
    Route::get('/Admin/Arsip-SP2D', [Arsp2dController::class, 'index'])->name('arsp2d')/* ->middleware('userAkses:superuser') */;
    Route::get('/Admin/Arsip-SP2D/Upload', [Arsp2dController::class, 'create'])->name('arsp2d-create')/* ->middleware('userAkses:superuser') */;
    Route::post('/Admin/Arsip-SP2D/store', [Arsp2dController::class, 'store'])->name('arsp2d-store')/* ->middleware('userAkses:superuser') */;
    Route::get('/download-file-sp2d/{id}', [Arsp2dController::class, 'downloadFile'])->name('download-file-sp2d')/* ->middleware('userAkses:superuser') */;
    Route::delete('/delete-file-sp2d/{id}', [Arsp2dController::class, 'deleteFile'])->name('delete-file-sp2d')/* ->middleware('userAkses:superuser') */;

    //Arsip SPM
    Route::get('/Admin/Arsip-SPM-Upload', [ArspmController::class, 'create'])->name('arspm-gu-create')/* ->middleware('userAkses:superuser') */;
    Route::post('/Admin/Arsip-SPM-store', [ArspmController::class, 'store'])->name('arspm-store')/* ->middleware('userAkses:superuser') */;

    Route::get('/Admin/Arsip-SPM-All', [ArspmallController::class, 'index'])->name('arspm-all')/* ->middleware('userAkses:superuser') */;
    Route::delete('/delete-file-all/{id}', [ArspmallController::class, 'deleteFile'])->name('delete-file-all')/* ->middleware('userAkses:superuser') */;

    Route::get('/Admin/Arsip-SPM-Gu', [ArspmguController::class, 'index'])->name('arspm-gu')/* ->middleware('userAkses:superuser') */;
    Route::get('/download-file-gu/{id}', [ArspmguController::class, 'downloadFile'])->name('download-file-gu')/* ->middleware('userAkses:superuser') */;
    Route::delete('/delete-file-gu/{id}', [ArspmguController::class, 'deleteFile'])->name('delete-file-gu')/* ->middleware('userAkses:superuser') */;

    Route::get('/Admin/Arsip-SPM-Tu', [ArspmtuController::class, 'index'])->name('arspm-tu')/* ->middleware('userAkses:superuser') */;
    Route::get('/download-file-tu/{id}', [ArspmtuController::class, 'downloadFile'])->name('download-file-tu')/* ->middleware('userAkses:superuser') */;
    Route::delete('/delete-file-tu/{id}', [ArspmtuController::class, 'deleteFile'])->name('delete-file-tu')/* ->middleware('userAkses:superuser') */;

    Route::get('/Admin/Arsip-SPM-Up', [ArspmupController::class, 'index'])->name('arspm-up')/* ->middleware('userAkses:superuser') */;
    Route::get('/download-file-up/{id}', [ArspmupController::class, 'downloadFile'])->name('download-file-up')/* ->middleware('userAkses:superuser') */;
    Route::delete('/delete-file-up/{id}', [ArspmupController::class, 'deleteFile'])->name('delete-file-up')/* ->middleware('userAkses:superuser') */;

    Route::get('/Admin/Arsip-SPM-Ls', [ArspmlsController::class, 'index'])->name('arspm-ls')/* ->middleware('userAkses:superuser') */;
    Route::get('/download-file-ls/{id}', [ArspmlsController::class, 'downloadFile'])->name('download-file-ls')/* ->middleware('userAkses:superuser') */;
    Route::delete('/delete-file-ls/{id}', [ArspmlsController::class, 'deleteFile'])->name('delete-file-ls')/* ->middleware('userAkses:superuser') */;


    //Arsip SPP
    Route::get('/Admin/Arsip-SPP-Up', [ArsppupController::class, 'index'])->name('arspp-up')/* ->middleware('userAkses:superuser') */;
    Route::get('/Admin/Arsip-SPP-Upload', [ArsppController::class, 'create'])->name('arspp-create')/* ->middleware('userAkses:superuser') */;
    Route::get('/Admin/Arsip-SPP-Tup', [ArspptupController::class, 'index'])->name('arspp-tup')/* ->middleware('userAkses:superuser') */;
    Route::get('/Admin/Arsip-SPP-ls', [ArspplsController::class, 'index'])->name('arspp-ls')/* ->middleware('userAkses:superuser') */;

    Route::get('/download-file-spp/{id}', [ArsppController::class, 'downloadFile'])->name('download-file-spp')/* ->middleware('userAkses:superuser') */;
    Route::post('/Admin/Arsip-SPP-store', [ArsppController::class, 'store'])->name('store-file-spp')/* ->middleware('userAkses:superuser') */;
    Route::delete('/delete-file-spp/{id}', [ArsppController::class, 'deleteFile'])->name('delete-file-spp')/* ->middleware('userAkses:superuser') */;

    //Hak Akses Keuangan
    // Route::get('/Keuangan/SP2D', [SP2DController::class, 'index'])->name('SP2DK')->middleware('userAkses:keuangan');
    Route::get('SPM', [SPMController::class, 'index'])->name('SPM')->middleware('userAkses:keuangan');


    //Hak Akses Dinas


});
