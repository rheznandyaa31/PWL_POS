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
    Route::get('/', [UserController::class, 'index']);          // Display the user dashboard
    Route::post('/list', [UserController::class, 'list']);      // Display user data
    Route::get('/create', [UserController::class, 'create']);   // Display form to add a user
    Route::post('/', [UserController::class, 'store']);         // Save new user data
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Display AJAX form to add a user
    Route::post('/ajax', [UserController::class, 'store_ajax']);        // Save new user data via AJAX
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);    // Display user details via AJAX
    Route::get('/{id}', [UserController::class, 'show']);       // Display user detail
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // Display form to edit user
    Route::put('/{id}', [UserController::class, 'update']);     // Save user data changes
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     // Display AJAX form to edit user
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Save user data changes via AJAX
    Route::get('/{id}/confirm_ajax', [UserController::class, 'confirm_ajax']); // Display AJAX confirmation for deleting a user
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Delete user data via AJAX
    Route::delete('/{id}', [UserController::class, 'destroy']); // Delete user
});

Route::group(['prefix' => 'level'], function() {
    Route::get('/', [LevelController::class, 'index']);          // Display the level dashboard
    Route::post('/list', [LevelController::class, 'list']);      // Display level data
    Route::get('/create', [LevelController::class, 'create']);   // Display form to add a level
    Route::post('/', [LevelController::class, 'store']);         // Save new level data
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Display AJAX form to add a level
    Route::post('/ajax', [LevelController::class, 'store_ajax']);        // Save new level data via AJAX
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);    // Display level details via AJAX
    Route::get('/{id}', [LevelController::class, 'show']);       // Display level detail
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  // Display form to edit level
    Route::put('/{id}', [LevelController::class, 'update']);     // Save level data changes
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);     // Display AJAX form to edit level
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Save level data changes via AJAX
    Route::get('/{id}/confirm_ajax', [LevelController::class, 'confirm_ajax']); // Display AJAX confirmation for deleting a level
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Delete level data via AJAX
    Route::delete('/{id}', [LevelController::class, 'destroy']); // Delete level
});

Route::group(['prefix' => 'kategori'], function() {
    Route::get('/', [KategoriController::class, 'index']);          // Display the category dashboard
    Route::post('/list', [KategoriController::class, 'list']);      // Display category data
    Route::get('/create', [KategoriController::class, 'create']);   // Display form to add a category
    Route::post('/', [KategoriController::class, 'store']);         // Save new category data
    Route::get('/{id}', [KategoriController::class, 'show']);       // Display category detail
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // Display form to edit category
    Route::put('/{id}', [KategoriController::class, 'update']);     // Save category data changes
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // Delete category
});

Route::group(['prefix' => 'supplier'], function() {
    Route::get('/', [SupplierController::class, 'index']);          // Display the supplier dashboard
    Route::post('/list', [SupplierController::class, 'list']);      // Display supplier data
    Route::get('/create', [SupplierController::class, 'create']);   // Display form to add a supplier
    Route::post('/', [SupplierController::class, 'store']);         // Save new supplier data
    Route::get('/{id}', [SupplierController::class, 'show']);       // Display supplier detail
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // Display form to edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     // Save supplier data changes
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // Delete supplier
});

Route::group(['prefix' => 'barang'], function() {
    Route::get('/', [BarangController::class, 'index']);          // Display the items dashboard
    Route::post('/list', [BarangController::class, 'list']);      // Display item data
    Route::get('/create', [BarangController::class, 'create']);   // Display form to add an item
    Route::post('/', [BarangController::class, 'store']);         // Save new item data
    Route::get('/{id}', [BarangController::class, 'show']);       // Display item detail
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  // Display form to edit item
    Route::put('/{id}', [BarangController::class, 'update']);     // Save item data changes
    Route::delete('/{id}', [BarangController::class, 'destroy']); // Delete item
});
