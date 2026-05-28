@extends('layouts.app')
@section('page-title', 'Payroll')
@section('content')
<div class="page-header"><div><h1>Payroll Listing</h1><p>Net Salary = Salary + Bonus - Deduction.</p></div><a class="btn btn-primary" href="{{ route('payrolls.create') }}"><i class="fa-solid fa-plus"></i> Add Payroll</a></div>
<div class="card"><div class="card-body">@include('payrolls.partials.table')</div></div>
{{ $payrolls->links() }}
@endsection
