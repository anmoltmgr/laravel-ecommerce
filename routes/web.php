<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\admin\AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get("/categories", [CategoryController::class, 'categoryIndex'])->name('categories.index');
        Route::get("/categories/create", [CategoryController::class, 'createCategory'])->name('categories.create');
        Route::post("/categories/create", [CategoryController::class, 'storeCategory'])->name('categories.store');

        Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('temp-images.create');

        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');
    });
});
