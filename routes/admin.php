<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Auth\Admin\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['admin'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    //Dashboard Route
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    //Profile Route
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/update-profile', [HomeController::class, 'updateProfile'])->name('update-profile');

    //Change Password Route
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/update-change-password', [HomeController::class, 'updateChangePassword'])->name('update-change-password');


    Route::prefix('role-and-permission')->group(function () {
        
        Route::prefix('modules')->name('modules.')->group(function () {
            Route::get('/', [ModuleController::class, 'index'])->name('index');
            Route::get('/create', [ModuleController::class, 'create'])->name('create');
            Route::post('/store', [ModuleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ModuleController::class, 'update'])->name('update');
            Route::post('/status/{id}', [ModuleController::class, 'status'])->name('status');
            Route::delete('/destroy/{id}', [ModuleController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('roles')->name('roles.')->group(function () {
            Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
        });
        
        Route::prefix('permissions')->name('permissions.')->group(function () {
            Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
        });

    });


    
});
