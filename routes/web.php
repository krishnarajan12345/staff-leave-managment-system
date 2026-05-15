<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('leave_types', App\Http\Controllers\Admin\LeaveTypeController::class);
    });

    Route::middleware('role:manager')->prefix('manager')->name('manager.')->group(function () {
        Route::get('/', [App\Http\Controllers\Manager\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/leaves', [App\Http\Controllers\Manager\LeaveController::class, 'index'])->name('leaves');
        Route::post('/leaves/{leaveApplication}/approve', [App\Http\Controllers\Manager\LeaveController::class, 'approve'])->name('leaves.approve');
        Route::post('/leaves/{leaveApplication}/reject', [App\Http\Controllers\Manager\LeaveController::class, 'reject'])->name('leaves.reject');
    });

    Route::middleware('role:employee')->prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/leaves/create', [App\Http\Controllers\Employee\LeaveController::class, 'create'])->name('leaves.create');
        Route::post('/leaves', [App\Http\Controllers\Employee\LeaveController::class, 'store'])->name('leaves.store');
        Route::delete('/leaves/{leaveApplication}', [App\Http\Controllers\Employee\LeaveController::class, 'destroy'])->name('leaves.destroy');
    });
});
