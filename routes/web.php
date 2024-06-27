<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaptchaController;


Auth::routes();
// Home Route -- User Dashboard
//find out why it's not working
// Route::resource('user/', UserController::class)->names([
//     'index' => 'user.index',
//     'create' => 'user.create',
//     'destroy' => 'user.destroy',
//     'edit' => 'user.edit',
//     'show' => 'user.show',
//     'store' => 'user.store',
//     'update' => 'user.update',
// ]);

// Route resources for administrators list in Admin side
Route::resource('administrator/administrators', AdministratorController::class)->names([
    'index' => 'administrator.index',
    'create' => 'administrator.create',
    'destroy' => 'administrator.destroy',
    'edit' => 'administrator.edit',
    'show' => 'administrator.show',
    'store' => 'administrator.store',
    'update' => 'administrator.update',
]);
// Route resources for Users list in Admin side
Route::resource('administrator/users', AdminUserController::class)->names([
    'index' => 'admin.users.index',
    'create' => 'admin.users.create',
    'destroy' => 'admin.users.destroy',
    'edit' => 'admin.users.edit',
    'show' => 'admin.users.show',
    'store' => 'admin.users.store',
    'update' => 'admin.users.update',
]);
// Route resources for departments list in Admin side.
Route::resource('administrator/department', DepartmentController::class);

// User dashboard
Route::get('user/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user.dashboard');
Route::get('user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('user/', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('user/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');


// Admin Dashboard Route -- Redirect
Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');

// Admin Dashboard Route
Route::get('administrator/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('admin.dashboard');

// Additional routes for Administrator CRUD for Users list.
Route::delete('administrator/users', [App\Http\Controllers\AdminUserController::class, 'destroySelected'])->name('admin.users.deleteSelected');
// Route::get('administrator/user/filter/', [App\Http\Controllers\AdminUserController::class, 'filter'])->name('admin.users.search');

// Additional routes for Administrator
Route::delete('administrator/administrator/', [App\Http\Controllers\AdministratorController::class, 'destroySelected'])->name('administrator.deleteSelected');

// Additional routes for Department
Route::delete('administrator/department/', [App\Http\Controllers\DepartmentController::class, 'destroySelected'])->name('department.deleteSelected');

// CAPTCHA routes
Route::get('captcha', [CaptchaController::class, 'getCaptcha'])->name('captcha.get');
Route::get('refresh-captcha', [CaptchaController::class, 'refreshCaptcha'])->name('refresh.captcha');

// Route::get('/storage/{id}', [UserController::class, 'viewPDF'])->name('view.pdf');
Route::get('/storage/{id}', [AdminUserController::class, 'viewPDF'])->name('view.pdf');
Route::post('/administrator/users/notes', [AdminUserController::class, 'addNotes'])->name('add.notes');
Route::put('/administrator/users/{id}/status', [AdminUserController::class, 'updateStatus'])->name('update.applicant.status');
