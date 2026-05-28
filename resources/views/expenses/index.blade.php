@extends('layouts.app')
@section('page-title', 'Expenses')
@section('content')
<div class="page-header"><div><h1>Expense Listing</h1><p>Operational school expenses.</p></div><a class="btn btn-primary" href="{{ route('expenses.create') }}"><i class="fa-solid fa-plus"></i> Add Expense</a></div>
<div class="card"><div class="card-body">@include('expenses.partials.table')</div></div>
{{ $expenses->links() }}
@endsection
