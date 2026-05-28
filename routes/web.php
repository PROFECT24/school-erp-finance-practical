<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/api/login', [AuthController::class, 'apiLogin'])->middleware('guest')->name('api.login');
Route::post('/api/logout', [AuthController::class, 'apiLogout'])->middleware('auth')->name('api.logout');

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('incomes', IncomeController::class);
    Route::get('incomes/{income}/receipt', [IncomeController::class, 'receipt'])->name('incomes.receipt');

    Route::resource('expenses', ExpenseController::class);
    Route::resource('payrolls', PayrollController::class);

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/pdf', [ReportController::class, 'pdf'])->name('reports.pdf');
    Route::get('reports/excel', [ReportController::class, 'excel'])->name('reports.excel');

    Route::prefix('api')->name('api.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'api'])->name('dashboard');
        Route::get('reports', [ReportController::class, 'api'])->name('reports');
        Route::apiResource('incomes', IncomeController::class);
        Route::apiResource('expenses', ExpenseController::class);
        Route::apiResource('payrolls', PayrollController::class);
    });
});
