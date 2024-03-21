<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('manage-permission',PermissionController::class);
    Route::resource('manage-role', RoleController::class);
    Route::put('assign-permission/{id}',[RoleController::class,'assignPermission'])->name('assingPermission');

    Route::get('list-users',[\App\Http\Controllers\UserController::class,'index'])->name('list-users');
    Route::get('assign-role/{id}',[\App\Http\Controllers\UserController::class,'assignRole'])->name('assignRole');
    Route::put('set-role/{id}',[\App\Http\Controllers\UserController::class,'setRoleUser'])->name('setRole');

});

require __DIR__.'/auth.php';
