<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $report = $this->buildReport($request);

        return view('reports.index', $report);
    }

    public function api(Request $request)
    {
        return response()->json(['data' => $this->buildReport($request)]);
    }

    public function pdf(Request $request)
    {
        $report = $this->buildReport($request);

        return Pdf::loadView('pdf.financial-summary', $report)
            ->setPaper('a4')
            ->download('financial-summary-' . now()->format('Ymd-His') . '.pdf');
    }

    public function excel(Request $request): StreamedResponse
    {
        $report = $this->buildReport($request);
        $filename = 'financial-summary-' . now()->format('Ymd-His') . '.xls';

        return response()->streamDownload(function () use ($report) {
            echo view('reports.excel', $report)->render();
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    private function buildReport(Request $request): array
    {
        [$from, $to] = $this->dateRange($request);

        $incomes = $this->filterByDate(Income::query(), 'payment_date', $from, $to)->orderBy('payment_date')->get();
        $expenses = $this->filterByDate(Expense::query(), 'expense_date', $from, $to)->orderBy('expense_date')->get();
        $payrolls = $this->filterByDate(Payroll::query(), 'payroll_date', $from, $to)->orderBy('payroll_date')->get();

        $totalIncome = (float) $incomes->sum('amount');
        $totalExpenses = (float) $expenses->sum('amount');
        $totalPayroll = (float) $payrolls->sum('net_salary');

        return [
            'from' => $from,
            'to' => $to,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'payrolls' => $payrolls,
            'totals' => [
                'income' => $totalIncome,
                'expenses' => $totalExpenses,
                'payroll' => $totalPayroll,
                'profit' => $totalIncome - ($totalExpenses + $totalPayroll),
            ],
        ];
    }

    private function dateRange(Request $request): array
    {
        if ($request->filled('month')) {
            $month = Carbon::createFromFormat('Y-m', $request->input('month'));

            return [$month->copy()->startOfMonth()->toDateString(), $month->copy()->endOfMonth()->toDateString()];
        }

        return [
            $request->input('from', now()->startOfMonth()->toDateString()),
            $request->input('to', now()->endOfMonth()->toDateString()),
        ];
    }

    private function filterByDate(Builder $query, string $column, string $from, string $to): Builder
    {
        return $query->whereBetween($column, [$from, $to]);
    }
}
