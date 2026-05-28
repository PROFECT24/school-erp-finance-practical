@extends('layouts.app')
@section('page-title', 'Reports')
@section('content')
<div class="page-header">
    <div><h1>Financial Summary</h1><p>Filter by month or date range, then export PDF or Excel.</p></div>
    <div class="ph-right">
        <a class="btn btn-outline" href="{{ route('reports.excel', request()->query()) }}"><i class="fa-solid fa-file-excel"></i> Excel</a>
        <a class="btn btn-primary" href="{{ route('reports.pdf', request()->query()) }}"><i class="fa-solid fa-file-pdf"></i> PDF</a>
    </div>
</div>
<div class="card" style="margin-bottom:20px;"><div class="card-body">
    <form class="grid-2" method="GET" action="{{ route('reports.index') }}">
        <div class="form-group"><label>Month Filter</label><input class="form-control" type="month" name="month" value="{{ request('month') }}"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr auto;gap:10px;align-items:end;">
            <div class="form-group"><label>From</label><input class="form-control" type="date" name="from" value="{{ $from }}"></div>
            <div class="form-group"><label>To</label><input class="form-control" type="date" name="to" value="{{ $to }}"></div>
            <button class="btn btn-primary" style="margin-bottom:16px;"><i class="fa-solid fa-filter"></i> Apply</button>
        </div>
    </form>
</div></div>
@include('reports.partials.cards', ['totals' => $totals])
<div class="grid-2 section-gap">
    <div class="card"><div class="card-header"><div class="card-title">Income Summary</div></div><div class="card-body">@include('incomes.partials.table', ['compact' => true])</div></div>
    <div class="card"><div class="card-header"><div class="card-title">Expense Summary</div></div><div class="card-body">@include('expenses.partials.table', ['compact' => true])</div></div>
</div>
<div class="card section-gap"><div class="card-header"><div class="card-title">Payroll Summary</div></div><div class="card-body">@include('payrolls.partials.table', ['compact' => true])</div></div>
@endsection
