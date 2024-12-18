<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RtProfileController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\OrganizationStructureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Public Information Routes
Route::group(['as' => 'public.'], function () {
    Route::get('/rt-profile', [RtProfileController::class, 'index'])->name('rt-profile.index');
    Route::get('/organization', [OrganizationStructureController::class, 'index'])->name('organization.index');
    Route::get('/regulations', [RegulationController::class, 'index'])->name('regulations.index');
    Route::get('/regulations/{regulation}', [RegulationController::class, 'show'])->name('regulations.show');
});

// Authentication Required Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Admin Only Routes
    Route::middleware('role:Admin')->group(function () {
        // Roles Management
        Route::resource('roles', RoleController::class);

        // RT Profile Management
        Route::controller(RtProfileController::class)->group(function () {
            Route::get('/rt-profile/edit', 'edit')->name('rt-profile.edit');
            Route::put('/rt-profile', 'update')->name('rt-profile.update');
        });

        // Organization Structure Management
        Route::controller(OrganizationStructureController::class)->prefix('organization')->name('organization.')->group(function () {
            Route::post('/', 'store')->name('store');
            Route::put('/{structure}', 'update')->name('update');
            Route::delete('/{structure}', 'destroy')->name('destroy');
        });

        // Regulations Management
        Route::controller(RegulationController::class)->prefix('regulations')->name('regulations.')->group(function () {
            Route::post('/', 'store')->name('store');
            Route::put('/{regulation}', 'update')->name('update');
            Route::delete('/{regulation}', 'destroy')->name('destroy');
        });
    });
});

require __DIR__ . '/auth.php';
