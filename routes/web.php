<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\testController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('home');
})->name('app');
Route::get('/registration-page',[AuthController::class, 'fetchRegisterPage'])->name('load.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/attempt', [AuthController::class, 'loginAttempt'])->name('login.attempt')->middleware('check_user');

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile',[AuthController::class, 'profile'])->name('profile');
    Route::get('/home',[HomeController::class, 'index'])->name('home');
});


Route::controller(AdminController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('admin/view-users','viewUsers')->name('admin.users');
    Route::get('admin/user-edit/{user}', 'editUser')->name('admin.user.edit');
    Route::put('admin/user-update/{user}', 'updateUser')->name('admin.user.update');
    Route::delete('admin/user-delete/{user}', 'deleteUser')->name('admin.user.delete');
    Route::post('admin/user-toggle-status/{user}', 'toggleUserStatus')->name('admin.user.toggle_status');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
});

Route::controller(EditorController::class)
    ->middleware(['auth', 'role:editor'])
    ->group(function () {

        Route::get('/editor/dashboard', 'editorDashboard')->name('editor.dashboard');
        Route::get('/editor/create-post-form', 'createPostForm')->name('editor.create-post-form');
        Route::post('/editor/create-post', 'createPost')->name('editor.create-post');

    });

Route::resource('test', testController::class);

Route::get('/checkout', [PaymentController::class, 'checkout']);
Route::get('/success', [PaymentController::class, 'success'])->name('success');
Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');

Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');
