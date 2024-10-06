<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);                     // Menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);                 // Menampilkan data user
    Route::get('/create', [UserController::class, 'create']);              // Menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);                    // Menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);    // Menampilkan halaman form tambah user AJAX
    Route::post('/ajax', [UserController::class, 'store_ajax']);            // Menyimpan data user baru AJAX
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);    // Menampilkan detail user AJAX
    Route::get('/{id}', [UserController::class, 'show']);                  // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);             // Menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);                // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);    // Menampilkan halaman form edit user AJAX
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user AJAX
    Route::get('/{id}/confirm_ajax', [UserController::class, 'confirm_ajax']); // Konfirmasi hapus data user AJAX
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Menghapus data user AJAX
    Route::delete('/{id}', [UserController::class, 'destroy']);            // Menghapus data user
});

Route::group(['prefix' => 'level'], function() {
    Route::get('/', [LevelController::class, 'index']);                     // Menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']);                 // Menampilkan data level
    Route::get('/create', [LevelController::class, 'create']);              // Menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);                    // Menyimpan data level baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);    // Menampilkan halaman form tambah level AJAX
    Route::post('/ajax', [LevelController::class, 'store_ajax']);            // Menyimpan data level baru AJAX
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);    // Menampilkan detail level AJAX
    Route::get('/{id}', [LevelController::class, 'show']);                  // Menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);             // Menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);                // Menyimpan perubahan data level
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);    // Menampilkan halaman form edit level AJAX
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level AJAX
    Route::get('/{id}/confirm_ajax', [LevelController::class, 'confirm_ajax']); // Konfirmasi hapus data level AJAX
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Menghapus data level AJAX
    Route::delete('/{id}', [LevelController::class, 'destroy']);            // Menghapus data level
});

Route::group(['prefix' => 'kategori'], function() {
    Route::get('/', [KategoriController::class, 'index']);                   // Menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);               // Menampilkan data kategori
    Route::get('/create', [KategoriController::class, 'create']);            // Menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);                  // Menyimpan data kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);  // Menampilkan halaman form tambah kategori AJAX
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);          // Menyimpan data kategori baru AJAX
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);  // Menampilkan detail kategori AJAX
    Route::get('/{id}', [KategoriController::class, 'show']);                // Menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);           // Menampilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);              // Menyimpan perubahan data kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);  // Menampilkan halaman form edit kategori AJAX
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // Menyimpan perubahan data kategori AJAX
    Route::get('/{id}/confirm_ajax', [KategoriController::class, 'confirm_ajax']); // Konfirmasi hapus data kategori AJAX
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Menghapus data kategori AJAX
    Route::delete('/{id}', [KategoriController::class, 'destroy']);          // Menghapus data kategori
});

Route::group(['prefix' => 'supplier'], function() {
    Route::get('/', [SupplierController::class, 'index']);                   // Menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);               // Menampilkan data supplier
    Route::get('/create', [SupplierController::class, 'create']);            // Menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class, 'store']);                  // Menyimpan data supplier baru
    Route::get('/{id}', [SupplierController::class, 'show']);                // Menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);           // Menampilkan halaman form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']);              // Menyimpan perubahan data supplier
    Route::delete('/{id}', [SupplierController::class, 'destroy']);          // Menghapus data supplier
});

Route::group(['prefix' => 'barang'], function() {
    Route::get('/', [BarangController::class, 'index']);                     // Menampilkan halaman awal barang
    Route::post('/list', [BarangController::class, 'list']);                 // Menampilkan data barang
    Route::get('/create', [BarangController::class, 'create']);              // Menampilkan halaman form tambah barang
    Route::post('/', [BarangController::class, 'store']);                    // Menyimpan data barang baru
    Route::get('/{id}', [BarangController::class, 'show']);                  // Menampilkan detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);             // Menampilkan halaman form edit barang
    Route::put('/{id}', [BarangController::class, 'update']);                // Menyimpan perubahan data barang
Route::delete('/{id}', [BarangController::class, 'destroy']);            // Menghapus data barang
});

