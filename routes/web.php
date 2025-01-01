<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\HomeController;

//! Public
Auth::routes();

// Route Users -- Redirect
Route::get('/', [HomeController::class, 'index'])->name('home');

//! ADMIN
Route::prefix('administrator')
    ->middleware(['auth', 'is.admin'])
    ->group(function () {

        // Admin Dashboard Route
        Route::get('dashboard', [AdministratorController::class, 'dashboard'])->name('admin.dashboard');

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
        Route::delete('users', [AdminUserController::class, 'destroySelected'])->name('admin.users.deleteSelected');
        // Additional routes for Administrator
        Route::delete('administrator/', [AdministratorController::class, 'destroySelected'])->name('administrator.deleteSelected');
        // Additional routes for Department
        Route::delete('department/', [DepartmentController::class, 'destroySelected'])->name('department.deleteSelected');

        //administrator user's additional controller
        Route::post('users/notes', [AdminUserController::class, 'addNotes'])->name('add.notes');
        Route::put('users/{id}/status', [AdminUserController::class, 'updateStatus'])->name('update.applicant.status');

        //applicant edit profile module
        Route::put('users/{id}/profile', [AdminUserController::class, 'updateProfile'])->name('update.user.profile');
        Route::put('users/{id}/skillset', [AdminUserController::class, 'updateSkillsets'])->name('update.user.skillsets');
        Route::put('users/{id}/references', [AdminUserController::class, 'updateReferences'])->name('update.user.references');
        // Route::put('users/{id}/files', [AdminUserController::class, 'updateFiles'])->name('update.user.files');
        Route::put('users/{id}/password', [AdminUserController::class, 'updatePassword'])->name('update.user.password');
        Route::post('users/files/upload/{field}', [AdminUserController::class, 'storeFile'])->name('update.user.storeFile');
        Route::put('users/files/{id}/update/{field}', [AdminUserController::class, 'updateFile'])->name('update.user.updateFile');
        Route::put('users/files/{id}/delete/{field}', [AdminUserController::class, 'deleteFile'])->name('update.user.deleteFile');
        Route::post('users/experiences/{id}', [AdminUserController::class, 'addExperiences'])->name('update.user.experience');
        Route::delete('users/experiences/{id}/delete/', [AdminUserController::class, 'deleteExperience'])->name('update.user.deleteExperience');
    });

//! User dashboard
Route::middleware('auth')
    ->group(function () {
        Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user/store', [UserController::class, 'store'])->name('user.store');
        Route::post('user/experience', [UserController::class, 'experiences'])->name('user.experience');
        Route::post('user/uploadMockcall', [UserController::class, 'uploadMockcall'])->name('user.mockcall');
        Route::post('user/references', [UserController::class, 'storeReferences'])->name('user.references.store');
        Route::delete('user/experiences/{id}', [UserController::class, 'destroyExperience'])->name('user.experienceDelete');
});
Route::middleware(['auth', 'check.user.id'])
    ->group(function () {
        Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
});

//! Public
// CAPTCHA routes
Route::get('captcha', [CaptchaController::class, 'getCaptcha'])->name('captcha.get');
Route::get('refresh-captcha', [CaptchaController::class, 'refreshCaptcha'])->name('refresh.captcha');

Route::get('/storage/{id}', [AdminUserController::class, 'viewPDF'])->name('view.pdf');
