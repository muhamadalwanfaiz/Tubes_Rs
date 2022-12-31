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
    return view('welcome');
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
