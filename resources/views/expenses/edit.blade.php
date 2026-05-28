@extends('layouts.app')
@section('page-title', 'Edit Expense')
@section('content')
<div class="page-header"><div><h1>Edit Expense</h1><p>Update recorded expense details.</p></div></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ route('expenses.update', $expense) }}">@include('expenses.partials.form')</form></div></div>
@endsection
