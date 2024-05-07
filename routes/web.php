<?php

use App\Http\Controllers\AdminControllerOne;
use App\Http\Controllers\EmployeeControllerOne;
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
    return view('login');
});

Route::get('/dashboard', function () {
    return view('index');
})->name('dashboard');

Route::get('experiment', function () {
    return view('backupindex');
});

Route::resource('datakaryawan', AdminControllerOne::class);
Route::resource('pengajuancuti', EmployeeControllerOne::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
