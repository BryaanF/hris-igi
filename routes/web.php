<?php

use App\Http\Controllers\AdminControllerFive;
use App\Http\Controllers\AdminControllerFour;
use App\Http\Controllers\AdminControllerOne;
use App\Http\Controllers\AdminControllerThree;
use App\Http\Controllers\AdminControllerTwo;
use App\Http\Controllers\EmployeeControllerOne;
use App\Http\Controllers\EmployeeControllerThree;
use App\Http\Controllers\EmployeeControllerTwo;
use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\ProfileController;
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

// redirect rute root ke dashboard
Route::redirect('/', 'dashboard');

// grouping untuk route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // route untuk menampilkan dashboard HRIS IGI
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');

    // route untuk admin
    // route halaman data karyawan
    Route::resource('datakaryawan', AdminControllerOne::class);
    Route::get('getDataKaryawan', [AdminControllerOne::class, 'getData'])->name('datakaryawan.getData');
    Route::get('exportExcelDataKaryawan', [AdminControllerOne::class, 'exportExcel'])->name('datakaryawan.exportExcel');
    Route::get('exportPDFDataKaryawan', [AdminControllerOne::class, 'exportPDF'])->name('datakaryawan.exportPDF');
    // route halaman rekrutmen
    Route::resource('rekrutmen', AdminControllerTwo::class);
    Route::get('getRekrutmen', [AdminControllerTwo::class, 'getData'])->name('rekrutmen.getData');
    // route halaman daftar absensi
    Route::resource('daftarabsensi', AdminControllerThree::class);
    // route halaman persetujuan cuti
    Route::resource('persetujuancuti', AdminControllerFour::class);
    // route halaman penggajian
    Route::resource('penggajian', AdminControllerFive::class);

    // route untuk karyawan
    // route pengajuan cuti
    Route::resource('pengajuancuti', EmployeeControllerOne::class);
    // route riwayat gaji
    Route::resource('riwayatgaji', EmployeeControllerTwo::class);
    // route absensi karyawan
    Route::resource('absensi', EmployeeControllerThree::class);

    // route untuk karyawan dan admin
    // route profile
    Route::resource('profile', ProfileController::class);

});

// experiment route
Route::get('experiment', ExperimentController::class);

// route untuk mengakses halaman login dan menampilkan viewnya
Auth::routes();
