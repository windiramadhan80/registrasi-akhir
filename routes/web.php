<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KtmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [KtmController::class, 'index']);
Route::get('/pencarian', [KtmController::class, 'pencarian']);
Route::get('/panduan', [KtmController::class, 'panduan']);

Route::get('redirects', [HomeController::class, 'index'])->name('redirects')->middleware('auth');

Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran')->middleware('auth');
Route::get('/createktm', [PendaftaranController::class, 'create'])->name('pendaftaran')->middleware('auth');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran')->middleware('auth');

Route::get('/ktm', [PendaftaranController::class, 'daftarktm'])->name('ktm')->middleware('auth');
Route::get('lihat/{id}', [PendaftaranController::class, 'show'])->name('lihat');

Route::get('edit/{id}', [HomeController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/edit/{id}', [HomeController::class, 'update'])->middleware('auth');

Route::delete('/hapus/{id}', [HomeController::class, 'destroy'])->middleware('auth');

Route::get('/search', [HomeController::class, 'search'])->middleware('auth');
Route::get('/searching', [PendaftaranController::class, 'search'])->middleware('auth');
