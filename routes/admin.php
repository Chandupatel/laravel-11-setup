<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'showLoginForm')->name('admin');
        Route::post('/login', 'login')->name('login');
    });

});

// Define a function for common routes
function registerCommonRoutes()
{
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::post('/status/{id}', 'status')->name('status');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
}

Route::middleware(['admin'])->group(function () {

    // Logout route
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // HomeController routes (Dashboard and Profile Management)
    Route::controller(HomeController::class)->group(function () {
        //Dashboard Route
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        // Profile Management
        Route::prefix('profile')->group(function () {
            Route::get('/', 'profile')->name('profile');
            Route::post('/update', 'updateProfile')->name('update-profile');
            Route::get('/change-password', 'changePassword')->name('change-password');
            Route::post('/update-password', 'updateChangePassword')->name('update-change-password');
        });
    });

    //Role And Permission Route
    Route::prefix('role-and-permission')->group(function () {

        //Modules Route
        Route::prefix('modules')
            ->name('modules.')
            ->controller(ModuleController::class)
            ->group(function () {
                registerCommonRoutes();
                Route::get('/get-sub-modules', 'getSubModules')->name('get-sub-modules');
            });

        //Roles Route
        Route::prefix('roles')
            ->name('roles.')
            ->controller(RoleController::class)
            ->group(callback: function () {
                registerCommonRoutes();
            });

        //Permission Route
        Route::prefix('permissions')
            ->name('permissions.')
            ->controller(PermissionController::class)
            ->group(callback: function () {
                registerCommonRoutes();
            });

    });

    Route::prefix('settings')
        ->name('settings.')
        ->controller(SettingController::class)
        ->group(function () {
            Route::get('/{group}', 'settingsGroup')->name('group');
            Route::post('/update/{group}', 'settingsGroupUpdate')->name('update.group');
        });
});
