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

Route::get('admin/pasiens', [App\Http\Controllers\AdminController::class, 'pasiens'])->name('admin.pasiens')->middleware('is_admin');

Route::post('admin/pasien', [App\Http\Controllers\AdminController::class, 'submit_pasien'])->name('admin.pasien.submit')->middleware('is_admin');

Route::patch('admin/pasiens/update', [App\Http\Controllers\AdminController::class, 'update_pasien'])->name('admin.pasien.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataPasien/{id}', [App\Http\Controllers\AdminController::class, 'getDataPasien']);

Route::get('admin/dokters', [App\Http\Controllers\AdminController::class, 'dokters'])->name('admin.dokters')->middleware('is_admin');