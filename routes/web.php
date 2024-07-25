<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaptchaController;

//! Public
Auth::routes();

// Route Users -- Redirect
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//! ADMIN
Route::prefix('administrator')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {

        // Admin Dashboard Route
        Route::get('dashboard', [App\Http\Controllers\AdministratorController::class, 'dashboard'])->name('admin.dashboard');

        // Route resources for administrators list in Admin side
        Route::resource('administrators', AdministratorController::class)->names([
            'index' => 'administrator.index',
            'create' => 'administrator.create',
            'destroy' => 'administrator.destroy',
            'edit' => 'administrator.edit',
            'show' => 'administrator.show',
            'store' => 'administrator.store',
            'update' => 'administrator.update',
        ]);
        // Route resources for Users list in Admin side
        Route::resource('users', AdminUserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'destroy' => 'admin.users.destroy',
            'edit' => 'admin.users.edit',
            'show' => 'admin.users.show',
            'store' => 'admin.users.store',
            'update' => 'admin.users.update',
        ]);
        // Route resources for departments list in Admin side.
        Route::resource('department', DepartmentController::class);

        // Additional routes for Administrator Users list.
        Route::delete('users', [App\Http\Controllers\AdminUserController::class, 'destroySelected'])->name('admin.users.deleteSelected');
        // Additional routes for Administrator
        Route::delete('administrator/', [App\Http\Controllers\AdministratorController::class, 'destroySelected'])->name('administrator.deleteSelected');
        // Additional routes for Department
        Route::delete('department/', [App\Http\Controllers\DepartmentController::class, 'destroySelected'])->name('department.deleteSelected');

        //administrator user's additional controller
        Route::post('users/notes', [AdminUserController::class, 'addNotes'])->name('add.notes');
        Route::put('users/{id}/status', [AdminUserController::class, 'updateStatus'])->name('update.applicant.status');

        //applicant edit profile module
        Route::put('users/{id}/profile', [AdminUserController::class, 'updateProfile'])->name('update.user.profile');
        Route::put('users/{id}/skillset', [AdminUserController::class, 'updateSkillsets'])->name('update.user.skillsets');
        Route::put('users/{id}/files', [AdminUserController::class, 'updateFiles'])->name('update.user.files');
        Route::put('users/{id}/password', [AdminUserController::class, 'updatePassword'])->name('update.user.password');
        Route::put('users/files/{id}/update/{field}', [AdminUserController::class, 'updateFile'])->name('update.user.updateFile');
        Route::put('users/files/{id}/delete/{field}', [AdminUserController::class, 'deleteFile'])->name('update.user.deleteFile');
    });

//! User dashboard
Route::middleware('auth')
    ->group(function () {
        Route::get('user/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user.dashboard');
        Route::get('user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('user/', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('user/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
        Route::get('user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::put('user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::post('user/experience', [App\Http\Controllers\UserController::class, 'experiences'])->name('user.experience');
        Route::post('user/uploadMockcall', [App\Http\Controllers\UserController::class, 'uploadMockcall'])->name('user.mockcall');
        Route::delete('user/experiences/{id}', [App\Http\Controllers\UserController::class, 'destroyExperience'])->name('user.experienceDelete');
});

//! Public
// CAPTCHA routes
Route::get('captcha', [CaptchaController::class, 'getCaptcha'])->name('captcha.get');
Route::get('refresh-captcha', [CaptchaController::class, 'refreshCaptcha'])->name('refresh.captcha');

Route::get('/storage/{id}', [AdminUserController::class, 'viewPDF'])->name('view.pdf');
