<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'apiLogin'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'apiLogout'])->name('api.logout');
    Route::get('dashboard', [DashboardController::class, 'api'])->name('api.dashboard');
    Route::get('reports', [ReportController::class, 'api'])->name('api.reports');
    Route::apiResource('incomes', IncomeController::class);
    Route::apiResource('expenses', ExpenseController::class);
    Route::apiResource('payrolls', PayrollController::class);
});
