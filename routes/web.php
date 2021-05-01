<?php

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


Auth::routes();

// view frontend
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);
Route::get('/lihat-semua-mobil', [App\Http\Controllers\FrontendController::class, 'SemuaMobil'])->name('lihat-semua-mobil');
Route::get('/mobil/detail/{slug}', [App\Http\Controllers\FrontendController::class, 'detailMobil'])->name('detail');


// dashboard backend
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('user/ganti-password', [App\Http\Controllers\UserController::class, 'gantiPassword'])->name('ganti-password');
Route::get('user/setting-profile',[App\Http\Controllers\UserController::class, 'settingProfile'])->name('setting-profile');

Route::get('car/{id}', [App\Http\Controllers\CarController::class, 'createGallery'])->name('createGallery');
Route::get('remove/gallery/{id}', [App\Http\Controllers\GalleryController::class, 'removeGallery'])->name('remove.image');
Route::get('remove/car/{id}', [App\Http\Controllers\CarController::class, 'removeCar'])->name('remove.car');

Route::get('daftar-jadi-mitra/{id}', [App\Http\Controllers\UserController::class, 'daftarMitra'])->name('daftar.mitra');
Route::get('transaksi/diterima/{id}', [App\Http\Controllers\TransactionController::class, 'TransaksiDiterima'])->name('transaksi.diterima');
Route::get('transaksi/ditolak/{id}', [App\Http\Controllers\TransactionController::class, 'TransaksiDitolak'])->name('transaksi.ditolak');

Route::get('/data-semua-mobil', [App\Http\Controllers\CarController::class, 'semuaMobil'])->name('car.semuamobil');

// mobil di booking
Route::get('/data-riwayat-booking', [App\Http\Controllers\BookingController::class,'riwayatBooking'])->name('datariwayatbooking');

// ganti status mobil di booking menjadi dikembalikan
Route::get('/booking/dikembalikan/{id}', [App\Http\Controllers\BookingController::class, 'mobilDikembalikan'])->name('booking.selesai-rental');

// nonaktifkan user
Route::get('/user/nonaktifkan/{id}', [App\Http\Controllers\UserController::class, 'nonaktifkan'])->name('user.nonaktif');

// aktifkan user
Route::get('/user/aktifkan/{id}', [App\Http\Controllers\UserController::class, 'aktifkan'])->name('user.aktif');

// simpan mobil
Route::get('/simpan/mobil/{id}', [App\Http\Controllers\SimpanController::class, 'simpan'])->name('simpan.mobil');
Route::get('/simpan/mobil', [App\Http\Controllers\SimpanController::class, 'index'])->name('lihat-mobil-tersimpan');
Route::get('hapus/mobil/disimpan/{id}', [App\Http\Controllers\SimpanController::class, 'remove'])->name('hapus.mobil.disimpan');

Route::resource('booking', App\Http\Controllers\BookingController::class);
Route::resource('user', App\Http\Controllers\UserController::class);
Route::resource('category', App\Http\Controllers\CategoryController::class);
Route::resource('fasilitas', App\Http\Controllers\FasilitasController::class);
Route::resource('car', App\Http\Controllers\CarController::class);
Route::resource('gallery', App\Http\Controllers\GalleryController::class);
Route::resource('bank', App\Http\Controllers\BankController::class);
Route::resource('transaction', App\Http\Controllers\TransactionController::class);

Route::get('/ajax/fasilitas-mobil/search', [App\Http\Controllers\FasilitasController::class, 'ajaxSearch']);

