<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function(){

    Route::get('/', [WelcomeController::class, 'index']);

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
        Route::Post('/list', [UserController::class, 'list']);      // menampilkan data user
        Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']);        // menyimpan data user baru ajax
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);    // menampilkan halaman awal user ajax
        Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     // menampilkan halaman form edit user ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
        Route::get('/{id}/confirm_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilan form confirm delete user ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    // Menu User
    Route::middleware(['authorize:ADM'])->group(function() {
        Route::get('/user', [UserController::class, 'index']);          // menampilkan halaman awal user
        Route::Post('/user/list', [UserController::class, 'list']);      // menampilkan data user
        Route::get('/user/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user ajax
        Route::post('user//ajax', [UserController::class, 'store_ajax']);        // menyimpan data user baru ajax
        Route::get('/user/{id}/show_ajax', [UserController::class, 'show_ajax']);    // menampilkan halaman awal user ajax
        Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     // menampilkan halaman form edit user ajax
        Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
        Route::get('/user/{id}/confirm_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilan form confirm delete user ajax
        Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
    });
    
    /* Route::group(['prefix' => 'level'], function() {
        Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal level
        Route::Post('/list', [LevelController::class, 'list']);      // menampilkan data level
        Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
        Route::post('/', [LevelController::class, 'store']);         // menyimpan data level baru
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']);        // menyimpan data level baru ajax
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);    // menampilkan halaman awal level ajax
        Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
        Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);     // menampilkan halaman form edit level ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax
        Route::get('/{id}/confirm_ajax', [LevelController::class, 'confirm_ajax']); // untuk tampilan form confirm delete level ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
    }); */

    // Menu Level
    Route::middleware(['authorize:ADM'])->group(function() {
        Route::get('/level', [LevelController::class, 'index']);          // menampilkan halaman awal level
        Route::Post('/level/list', [LevelController::class, 'list']);      // menampilkan data level
        Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level ajax
        Route::post('level//ajax', [LevelController::class, 'store_ajax']);        // menyimpan data level baru ajax
        Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']);    // menampilkan halaman awal level ajax
        Route::get('/level/{id}', [LevelController::class, 'show']);       // menampilkan detail level
        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);     // menampilkan halaman form edit level ajax
        Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax
        Route::get('/level/{id}/confirm_ajax', [LevelController::class, 'confirm_ajax']); // untuk tampilan form confirm delete level ajax
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level ajax
    });
    
    Route::group(['prefix' => 'kategori'], function() {
        Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
        Route::Post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori
        Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
        Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);        // menyimpan data kategori baru ajax
        Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);    // menampilkan halaman awal kategori ajax
        Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
        Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);     // menampilkan halaman form edit kategori ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
        Route::get('/{id}/confirm_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilan form confirm delete kategori ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
    });
    
    Route::group(['prefix' => 'supplier'], function() {
        Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
        Route::Post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier
        Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
        Route::post('/', [SupplierController::class, 'store']);         // menyimpan data supplier baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah supplier ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);        // menyimpan data supplier baru ajax
        Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);    // menampilkan halaman awal supplier ajax
        Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
        Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);     // menampilkan halaman form edit supplier ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
        Route::get('/{id}/confirm_ajax', [SupplierController::class, 'confirm_ajax']); // untuk tampilan form confirm delete supplier ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data supplier ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
    });
    
    Route::group(['prefix' => 'barang'], function() {
        Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal barang
        Route::Post('/list', [BarangController::class, 'list']);      // menampilkan data barang
        Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
        Route::post('/', [BarangController::class, 'store']);         // menyimpan data barang baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah barang ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']);        // menyimpan data barang baru ajax
        Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);    // menampilkan halaman awal barang ajax
        Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
        Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
        Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);     // menampilkan halaman form edit barang ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang ajax
        Route::get('/{id}/confirm_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilan form confirm delete barang ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data barang ajax
        Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
    });
});
/* Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::Post('/list', [UserController::class, 'list']);      // menampilkan data user
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);        // menyimpan data user baru ajax
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);    // menampilkan halaman awal user ajax
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     // menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
    Route::get('/{id}/confirm_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});
Route::group(['prefix' => 'level'], function() {
    Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal level
    Route::Post('/list', [LevelController::class, 'list']);      // menampilkan data level
    Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);         // menyimpan data level baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']);        // menyimpan data level baru ajax
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);    // menampilkan halaman awal level ajax
    Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);     // menampilkan halaman form edit level ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax
    Route::get('/{id}/confirm_ajax', [LevelController::class, 'confirm_ajax']); // untuk tampilan form confirm delete level ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
});
Route::group(['prefix' => 'kategori'], function() {
    Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
    Route::Post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori
    Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);        // menyimpan data kategori baru ajax
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);    // menampilkan halaman awal kategori ajax
    Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);     // menampilkan halaman form edit kategori ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
    Route::get('/{id}/confirm_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilan form confirm delete kategori ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
});
    // Menu Kategori
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function() {
        Route::get('/kategori', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
        Route::Post('/kategori/list', [KategoriController::class, 'list']);      // menampilkan data kategori
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
        Route::post('kategori//ajax', [KategoriController::class, 'store_ajax']);        // menyimpan data kategori baru ajax
        Route::get('/kategori/{id}/show_ajax', [KategoriController::class, 'show_ajax']);    // menampilkan halaman awal kategori ajax
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);     // menampilkan halaman form edit kategori ajax
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
        Route::get('/kategori/{id}/confirm_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilan form confirm delete kategori ajax
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori ajax
    });

Route::group(['prefix' => 'supplier'], function() {
    Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
    Route::Post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier
    Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class, 'store']);         // menyimpan data supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah supplier ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);        // menyimpan data supplier baru ajax
    Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);    // menampilkan halaman awal supplier ajax
    Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);     // menampilkan halaman form edit supplier ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
    Route::get('/{id}/confirm_ajax', [SupplierController::class, 'confirm_ajax']); // untuk tampilan form confirm delete supplier ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data supplier ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
});
    // Menu Supplier
    Route::middleware(['authorize:ADM,MNG'])->group(function() {
        Route::get('/supplier', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
        Route::Post('/supplier/list', [SupplierController::class, 'list']);      // menampilkan data supplier
        Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah supplier ajax
        Route::post('supplier//ajax', [SupplierController::class, 'store_ajax']);        // menyimpan data supplier baru ajax
        Route::get('/supplier/{id}/show_ajax', [SupplierController::class, 'show_ajax']);    // menampilkan halaman awal supplier ajax
        Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);     // menampilkan halaman form edit supplier ajax
        Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
        Route::get('/supplier/{id}/confirm_ajax', [SupplierController::class, 'confirm_ajax']); // untuk tampilan form confirm delete supplier ajax
        Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data supplier ajax
    });

Route::group(['prefix' => 'barang'], function() {
    Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal barang
    Route::Post('/list', [BarangController::class, 'list']);      // menampilkan data barang
    Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
    Route::post('/', [BarangController::class, 'store']);         // menyimpan data barang baru
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah barang ajax
    Route::post('/ajax', [BarangController::class, 'store_ajax']);        // menyimpan data barang baru ajax
    Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);    // menampilkan halaman awal barang ajax
    Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
    Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);     // menampilkan halaman form edit barang ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang ajax
    Route::get('/{id}/confirm_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilan form confirm delete barang ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data barang ajax
    Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
}); */
    // Menu Barang
    Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function() {
        Route::get('/barang', [BarangController::class, 'index']);          // menampilkan halaman awal barang
        Route::Post('/barang/list', [BarangController::class, 'list']);      // menampilkan data barang
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah barang ajax
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']);        // menyimpan data barang baru ajax
        Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);    // menampilkan halaman awal barang ajax
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);     // menampilkan halaman form edit barang ajax
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang ajax
        Route::get('/barang/{id}/confirm_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilan form confirm delete barang ajax
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data barang ajax
    });
});