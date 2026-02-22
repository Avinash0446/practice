<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('home');
})->name('home');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/attempt', [AuthController::class, 'loginAttempt'])->name('login.attempt')->middleware('check_user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/profile',[AuthController::class, 'profile'])->name('profile')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/view-users',[AdminController::class, 'viewUsers'])->name('admin.users');
    Route::get('admin/user-edit/{user}', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::put('admin/user-update/{user}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('admin/user-delete/{user}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::post('admin/user-toggle-status/{user}', [AdminController::class, 'toggleUserStatus'])->name('admin.user.toggle_status');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
});

Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('/editor/dashboard', [EditorController::class, 'editorDashboard'])->name('editor.dashboard');
});
