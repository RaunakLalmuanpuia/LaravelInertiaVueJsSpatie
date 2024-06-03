<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//Create , edit, delete roles
Route::get('role', [RoleController::class, 'roles'])->middleware(['role:root'])->name('roles');
Route::post('role', [RoleController::class, 'storeRole'])->middleware(['role:root'])->name('storeRole');
Route::put('role/{role}', [RoleController::class, 'updateRole'])->middleware(['role:root'])->name('updateRole');
Route::delete('role/{role}', [RoleController::class, 'destroyRole'])->middleware(['role:root'])->name('destroyRole');

// Assign roles to users
Route::get('usersRole', [RoleController::class, 'users'])->middleware(['role:root'])->name('usersRole');
Route::post('users/{users}', [RoleController::class, 'updateUserRole'])->middleware(['role:root'])->name('updateUserRole');//Assign user role


Route::get('permissions',[PermissionController::class, 'index'])->middleware(['role:root'])->name('permissions');
Route::post('createPermission',[PermissionController::class, 'store'])->middleware(['role:root'])->name('createPermission');
Route::put('permissions/{permissions}',[PermissionController::class, 'update'])->middleware(['role:root'])->name('updatePermission');
Route::delete('permissions/{permissions}',[PermissionController::class, 'destroy'])->middleware(['role:root'])->name('destroyPermission');