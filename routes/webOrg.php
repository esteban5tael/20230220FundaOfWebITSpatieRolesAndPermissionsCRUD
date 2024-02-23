<?php

use App\Http\Controllers\_SiteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', _SiteController::class)->name('index');



Route::group(['middleware' => ['auth', 'role:Admin|Super-Admin']], function () {
    Route::view('/admin', 'admin.index')->name('admin.index');
});

Route::middleware(['auth'])->group(function () {


    Route::resource('permissions', PermissionController::class)->names('permissions');
    Route::resource('/roles', RoleController::class)->names('roles');
    Route::get('/roles/{role}/permissions', [RoleController::class, 'permissions'])->name('role.permissions');
    Route::put('/roles/{role}/permissions', [RoleController::class, 'permissionsUpdate'])->name('role.permissionsUpdate');
    Route::resource('users', UserController::class)->names('users');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
