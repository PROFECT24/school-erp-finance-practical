@extends('layouts.app')
@section('page-title', 'Income')
@section('content')
<div class="page-header"><div><h1>Income Listing</h1><p>Student fee collections with receipt PDF generation.</p></div><a class="btn btn-primary" href="{{ route('incomes.create') }}"><i class="fa-solid fa-plus"></i> Add Income</a></div>
<div class="card"><div class="card-body">@include('incomes.partials.table')</div></div>
{{ $incomes->links() }}
@endsection
