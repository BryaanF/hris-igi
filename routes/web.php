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

    // Grouping Routes untuk ADMINISTRATOR
    Route::middleware(['role:Administrator'])->group(function () {
        // route halaman data karyawan
        Route::resource('datakaryawan', AdminControllerOne::class);
        Route::get('getDataKaryawan', [AdminControllerOne::class, 'getData'])->name('datakaryawan.getData');
        Route::get('exportExcelDataKaryawan', [AdminControllerOne::class, 'exportExcel'])->name('datakaryawan.exportExcel');
        Route::get('exportPDFDataKaryawan', [AdminControllerOne::class, 'exportPDF'])->name('datakaryawan.exportPDF');
        // route halaman rekrutmen
        Route::resource('rekrutmen', AdminControllerTwo::class);
        Route::get('getRekrutmen', [AdminControllerTwo::class, 'getData'])->name('rekrutmen.getData');
        Route::post('statusRekrutmenQuery/{id}', [AdminControllerTwo::class, 'statusRekrutmenQuery'])->name('rekrutmen.statusRekrutmenQuery');
        Route::get('exportExcelDataRekrutmen', [AdminControllerTwo::class, 'exportExcel'])->name('rekrutmen.exportExcel');
        Route::get('exportPDFDataRekrutmen', [AdminControllerTwo::class, 'exportPDF'])->name('rekrutmen.exportPDF');
        // route halaman daftar absensi untuk admin
        Route::resource('daftarabsensi', AdminControllerThree::class);
        Route::get('getDaftarAbsensi', [AdminControllerThree::class, 'getData'])->name('daftarabsensi.getData');
        Route::post('generateabsensi', [AdminControllerThree::class, 'generateAbsenceData'])->name('daftarabsensi.generateAbsenceData');

        // route halaman persetujuan cuti
        Route::resource('persetujuancuti', AdminControllerFour::class);
        Route::get('getPersetujuanCuti', [AdminControllerFour::class, 'getData'])->name('persetujuancuti.getData');
        Route::get('exportExcelDataPersetujuanCuti', [AdminControllerFour::class, 'exportExcel'])->name('persetujuancuti.exportExcel');
        Route::get('exportPDFDataPersetujuanCuti', [AdminControllerFour::class, 'exportPDF'])->name('persetujuancuti.exportPDF');
        Route::post('statusCutiQuery/{id}', [AdminControllerFour::class, 'statusCutiQuery'])->name('persetujuancuti.statusCutiQuery');
        // route halaman penggajian
        Route::resource('penggajian', AdminControllerFive::class);
    });

    // Rute untuk KARYAWAN / EMPLOYEE
    // route pengajuan cuti
    Route::resource('pengajuancuti', EmployeeControllerOne::class);
    Route::get('getPengajuanCuti', [EmployeeControllerOne::class, 'getData'])->name('pengajuancuti.getData');
    // route riwayat gaji
    Route::resource('riwayatgaji', EmployeeControllerTwo::class);
    // route riwayat absensi untuk karyawan
    Route::get('riwayatabsensi', [EmployeeControllerThree::class, 'index'])->name('riwayatabsensi.index');
    Route::get('getRiwayatAbsensi', [EmployeeControllerThree::class, 'getRiwayatAbsensi'])->name('riwayatabsensi.getRiwayatAbsensi');

    // ROUTE FOR EMPLOYEE AND ADMIN
    // route profile
    Route::get('/profil/sunting', [ProfileController::class, 'sunting'])->name('profil.sunting');

    Route::resource('profil', ProfileController::class);

});

// Rute untuk kontroller semua, menangani manajemen aplikasi secara umum bagi semua pengguna, nama kontroller = AllController
// Route::post('/clear-modal-session', [AllController::class, 'clearSessionModal'])->name('clearSessionModal');

// experiment route
Route::get('experiment', ExperimentController::class);

// route untuk mengakses semua rute terkait autentikasi
Auth::routes();
