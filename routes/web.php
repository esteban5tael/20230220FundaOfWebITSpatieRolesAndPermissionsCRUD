<?php

use App\Http\Controllers\_SiteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\RegularExpression;

Route::get('/', _SiteController::class)->name('index');




Route::group(['middleware' => ['auth', 'role:Super-Admin|Admin|User|Staff']], function () {
    Route::view('/admin', 'admin.index')->name('admin.index');
});

Route::middleware(['auth'])->group(function () {


    // Rutas para permisos
    Route::get('permissions', [PermissionController::class, 'index'])->middleware('permission:View Permission')
        ->name('permissions.index');
    Route::post('permissions', [PermissionController::class, 'store'])->middleware('permission:Create Permission')
        ->name('permissions.store');
    Route::get('permissions/create', [PermissionController::class, 'create'])->middleware('permission:Create Permission')->name('permissions.create');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->middleware('permission:Edit Permission')->name('permissions.edit');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->middleware('permission:Edit Permission')->name('permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:Delete Permission')->name('permissions.destroy');

    // Rutas para roles
    Route::get('roles', [RoleController::class, 'index'])->middleware('permission:View Role')->name('roles.index');
    Route::post('roles', [RoleController::class, 'store'])->middleware('permission:Create Role')->name('roles.store');
    Route::get('roles/create', [RoleController::class, 'create'])->middleware('permission:Create Role')->name('roles.create');
    Route::put('roles/{role}', [RoleController::class, 'update'])->middleware('permission:Edit Permission')->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:Delete Permission')->name('roles.destroy');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:Edit Permission')->name('roles.edit');
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->middleware('permission:Create Permission')->name('role.permissions');
    Route::put('roles/{role}/permissions', [RoleController::class, 'permissionsUpdate'])->middleware('permission:Create Permission')->name('role.permissionsUpdate');

    // Rutas para usuarios
    Route::get('users', [UserController::class, 'index'])->middleware('permission:View User')->name('users.index');
    Route::post('users', [UserController::class, 'store'])->middleware('permission:Create User')->name('users.store');
    Route::get('users/create', [UserController::class, 'create'])->middleware('permission:Create User')->name('users.create');
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('permission:Edit User')->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('permission:Delete User')->name('users.destroy');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:Edit User')->name('users.edit');
});



Route::prefix('tests')->group(function () {
    Route::get('/super-admin', function(){
        return response()->json([
            'status'=>'success',
            'message'=>'This is an Super Admin Route'
        ],200);
    })
    ->middleware('role:Super-Admin')
    ->name('super-admin');
});




/*  */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
