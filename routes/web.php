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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('user/ganti-password', [App\Http\Controllers\UserController::class, 'gantiPassword'])->name('ganti-password');
Route::get('user/setting-profile',[App\Http\Controllers\UserController::class, 'settingProfile'])->name('setting-profile');

Route::get('car/{id}', [App\Http\Controllers\CarController::class, 'createGallery'])->name('createGallery');
Route::get('remove/gallery/{id}', [App\Http\Controllers\GalleryController::class, 'removeGallery'])->name('remove.image');
Route::get('remove/car/{id}', [App\Http\Controllers\CarController::class, 'removeCar'])->name('remove.car');

Route::resource('user', App\Http\Controllers\UserController::class);
Route::resource('category', App\Http\Controllers\CategoryController::class);
Route::resource('fasilitas', App\Http\Controllers\FasilitasController::class);
Route::resource('car', App\Http\Controllers\CarController::class);
Route::resource('gallery', App\Http\Controllers\GalleryController::class);

Route::get('/ajax/fasilitas-mobil/search', [App\Http\Controllers\FasilitasController::class, 'ajaxSearch']);

