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
Route::get('user/profile',[App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('user/ganti-password', [App\Http\Controllers\UserController::class, 'gantiPassword'])->name('ganti-password');
Route::get('user/setting-profile',[App\Http\Controllers\UserController::class, 'settingProfile'])->name('setting-profile');
Route::resource('user', App\Http\Controllers\UserController::class);
