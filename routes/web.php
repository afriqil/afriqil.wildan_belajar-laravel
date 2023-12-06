<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Inilah tempat di mana Anda bisa mendaftarkan rute web untuk aplikasi Anda.
| Semua rute ini dimuat oleh RouteServiceProvider dan akan diberikan
| ke dalam grup middleware "web". Buat sesuatu yang hebat!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::group(['middleware' => ['admin']], function () { // Perbaikan: Tambahkan tanda kurung buka disini
        Route::get('dashboard', 'AdminController@dashboard');
        Route::match (['get', 'post'],'update-password', 'AdminController@updatePassword' );
        Route::match (['get', 'post'],'update-details', 'AdminController@updateDetails' );
        Route::post ('check-current-password', 'AdminController@checkCurrentPassword');
        Route::get('logout', 'AdminController@logout');

        // Display CMS Pages (Crud - Read )
        Route::get('cms-pages', 'CmsController@index');
        Route::post('update-cms-page-status', 'CmsController@update');
        Route::match (['get', 'post'], 'add-edit-cms-pages/{id?}', 'CmsController@edit');
        Route::get('delete-cms-page/{id?}', 'CmsController@destroy');
    }); // Perbaikan: Tambahkan tanda kurung tutup disini
});
