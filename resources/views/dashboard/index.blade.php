@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <div><h1>Dashboard</h1><p>Dynamic school income, expense, payroll and net position.</p></div>
    <div class="ph-right">
        <a class="btn btn-outline" href="{{ route('reports.excel') }}"><i class="fa-solid fa-file-excel"></i> Excel</a>
        <a class="btn btn-primary" href="{{ route('reports.pdf') }}"><i class="fa-solid fa-file-pdf"></i> PDF Report</a>
    </div>
</div>
@include('reports.partials.cards', ['totals' => $totals])
<div class="grid-2 section-gap">
    <div class="card"><div class="card-header"><div class="card-title">Recent Income</div><a class="btn btn-primary btn-sm" href="{{ route('incomes.create') }}">Add Income</a></div>
        <div class="card-body">@include('incomes.partials.table', ['incomes' => $recentIncomes, 'compact' => true])</div></div>
    <div class="card"><div class="card-header"><div class="card-title">Recent Expenses</div><a class="btn btn-primary btn-sm" href="{{ route('expenses.create') }}">Add Expense</a></div>
        <div class="card-body">@include('expenses.partials.table', ['expenses' => $recentExpenses, 'compact' => true])</div></div>
</div>
<div class="card section-gap">
    <div class="card-header"><div class="card-title">Recent Payroll</div><a class="btn btn-primary btn-sm" href="{{ route('payrolls.create') }}">Add Payroll</a></div>
    <div class="card-body">@include('payrolls.partials.table', ['payrolls' => $recentPayrolls, 'compact' => true])</div>
</div>
@endsection
