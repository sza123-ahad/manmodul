<?php

use App\Http\Controllers\Admin\AdminController;
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
    return view('auth.login');
});

Route::post('proseslogin', 'Auth\AuthController@prosesLogin');
Route::get('logout','Auth\AuthController@logout');

Route::prefix('superadmin')->middleware('auth','akses:superadmin')->group(function(){
    Route::get('beranda','Superadmin\AdminController@index');
    Route::get('setting','Superadmin\AdminController@setting');
    Route::get('adduser','Superadmin\AdminController@adduser');
    Route::post('tambahuser','Superadmin\AdminController@prosestambahuser');
    Route::get('tampiluser','Superadmin\AdminController@tampiluser');
    Route::post('deleteuser','Superadmin\AdminController@deleteuser');
    Route::post('prosesedituser','Superadmin\AdminController@prosesedituser');
    Route::get('template','Superadmin\AdminController@template');
    Route::get('editwarna/{id}','Superadmin\AdminController@editwarna');
    Route::post('upimglogin','Superadmin\AdminController@upimglogin');
    Route::get('profil','Superadmin\AdminController@profil');
    Route::post('title_edit','Superadmin\AdminController@simpantitle');
    Route::post('bgloginedit','Superadmin\AdminController@bgloginedit');

    Route::get('setdb','Superadmin\AdminController@setdb');
    Route::get('aksibackup','Superadmin\AdminController@backupdb');
    Route::get('sendnotif','Superadmin\AdminController@notif');
    Route::get('bacanotif/{id}','Superadmin\AdminController@bacanotif');
    Route::get('manmenu','Superadmin\AdminController@manmenu');
    Route::post('simpanmenu','Superadmin\AdminController@simpanmenu');

    Route::get('kelolahelper','Superadmin\AdminController@kelolahelper');

    // Apiedit 
    Route::get('apiedit/{id}','Superadmin\AdminController@apiedit');
    Route::get('search_all','Superadmin\AdminController@searchall');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
