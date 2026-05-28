@extends('layouts.app')
@section('page-title', 'Add Expense')
@section('content')
<div class="page-header"><div><h1>Add Expense</h1><p>Record expense title, category, amount and date.</p></div></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ route('expenses.store') }}">@include('expenses.partials.form')</form></div></div>
@endsection
