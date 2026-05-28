<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Payroll;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totals = $this->totals();
        $recentIncomes = Income::latest('payment_date')->limit(5)->get();
        $recentExpenses = Expense::latest('expense_date')->limit(5)->get();
        $recentPayrolls = Payroll::latest('payroll_date')->limit(5)->get();

        return view('dashboard.index', compact('totals', 'recentIncomes', 'recentExpenses', 'recentPayrolls'));
    }

    public function api()
    {
        return response()->json([
            'data' => $this->totals(),
            'recent_income' => Income::latest('payment_date')->limit(5)->get(),
            'recent_expenses' => Expense::latest('expense_date')->limit(5)->get(),
            'recent_payrolls' => Payroll::latest('payroll_date')->limit(5)->get(),
        ]);
    }

    private function totals(): array
    {
        $income = (float) Income::sum('amount');
        $expenses = (float) Expense::sum('amount');
        $payroll = (float) Payroll::sum('net_salary');

        return [
            'income' => $income,
            'expenses' => $expenses,
            'payroll' => $payroll,
            'profit' => $income - ($expenses + $payroll),
        ];
    }
}
