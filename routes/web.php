<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
    return view('welcome');
});

Route::get('/vdrregistor',[RegisterController::class,'vdrregisterview'])->name('vdrregisterview');
Route::get('/uregisteor',[RegisterController::class,'uregisteorview'])->name('udregisteorview');
Route::post('/uregisteor',[RegisterController::class,'uregisteor'])->name('udregisteor');
Route::get('/ulogin',[LoginController::class,'uloginview'])->name('uloginview');
Route::post('/ulogin',[LoginController::class,'uloginauth'])->name('ulogin');
Route::get('/vendorlogin',[LoginController::class,'vendorlogin']);
Route::get('/adminlogin',[LoginController::class,'adminlogin']);
Route::post('/adminlogin',[LoginController::class,'adminloginauth'])->name('adminlogin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
