<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');


// PASIEN
Route::get('admin/pasiens', [App\Http\Controllers\AdminController::class, 'pasiens'])->name('admin.pasiens')->middleware('is_admin');

Route::post('admin/pasien', [App\Http\Controllers\AdminController::class, 'submit_pasien'])->name('admin.pasien.submit')->middleware('is_admin');

Route::patch('admin/pasiens/update', [App\Http\Controllers\AdminController::class, 'update_pasien'])->name('admin.pasien.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataPasien/{id}', [App\Http\Controllers\AdminController::class, 'getDataPasien']);

Route::post('admin/pasiens/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_pasien'])->name('admin.pasien.delete')->middleware('is_admin');

Route::get('admin/pasiens/export', [\App\Http\Controllers\AdminController::class, 'export'])->name('admin.pasien.export')->middleware('is_admin');

// DOKTER
Route::get('admin/dokters', [App\Http\Controllers\AdminDokterController::class, 'dokters'])->name('admin.dokters')->middleware('is_admin');

Route::post('admin/dokter', [App\Http\Controllers\AdminDokterController::class, 'submit_dokter'])->name('admin.dokter.submit')->middleware('is_admin');

Route::patch('admin/dokters/update', [App\Http\Controllers\AdminDokterController::class, 'update_dokter'])->name('admin.dokter.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataDokter/{id}', [App\Http\Controllers\AdminDokterController::class, 'getDataDokter']);

Route::post('admin/dokters/delete/{id}', [App\Http\Controllers\AdminDokterController::class, 'delete_dokter'])->name('admin.dokter.delete')->middleware('is_admin');

Route::get('admin/dokters/export', [\App\Http\Controllers\AdminDokterController::class, 'export'])->name('admin.dokter.export')->middleware('is_admin');

// KUNJUNGAN
Route::get('admin/kunjungans', [App\Http\Controllers\AdminKunjunganController::class, 'kunjungans'])->name('admin.kunjungans')->middleware('is_admin');

Route::post('admin/kunjungan', [App\Http\Controllers\AdminKunjunganController::class, 'submit_kunjungan'])->name('admin.kunjungan.submit')->middleware('is_admin');

Route::patch('admin/kunjungans/update', [App\Http\Controllers\AdminKunjunganController::class, 'update_kunjungan'])->name('admin.kunjungan.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataKunjungan/{id}', [App\Http\Controllers\AdminKunjunganController::class, 'getDataKunjungan']);

Route::post('admin/kunjungans/delete/{id}', [App\Http\Controllers\AdminKunjunganController::class, 'delete_kunjungan'])->name('admin.kunjungan.delete')->middleware('is_admin');

Route::get('admin/kunjungans/export', [App\Http\Controllers\AdminKunjunganController::class, 'export'])->name('admin.kunjungan.export')->middleware('is_admin');

Route::get('admin/kunjungans/pdf/{id}', [App\Http\Controllers\AdminKunjunganController::class, 'pdf_kunjungan'])->name('admin.kunjungan.pdf')->middleware('is_admin');

// PEMBAYARAN
Route::get('admin/pembayarans', [App\Http\Controllers\AdminPembayaranController::class, 'pembayarans'])->name('admin.pembayarans')->middleware('is_admin');

Route::post('admin/pembayaran', [App\Http\Controllers\AdminPembayaranController::class, 'submit_pembayaran'])->name('admin.pembayaran.submit')->middleware('is_admin');

Route::patch('admin/pembayarans/update', [App\Http\Controllers\AdminPembayaranController::class, 'update_pembayaran'])->name('admin.pembayaran.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataPembayaran/{id}', [App\Http\Controllers\AdminPembayaranController::class, 'getDataPembayaran']);

Route::post('admin/pembayarans/delete/{id}', [App\Http\Controllers\AdminPembayaranController::class, 'delete_pembayaran'])->name('admin.pembayaran.delete')->middleware('is_admin');

Route::get('admin/pembayarans/export', [App\Http\Controllers\AdminPembayaranController::class, 'export'])->name('admin.pembayaran.export')->middleware('is_admin');

Route::get('admin/kunjungans/pdf', [App\Http\Controllers\AdminPembayaranController::class, 'pdf_pembayaran'])->name('admin.pembayaran.pdf')->middleware('is_admin');