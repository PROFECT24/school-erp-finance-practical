@extends('layouts.app')
@section('page-title', 'Edit Income')
@section('content')
<div class="page-header"><div><h1>Edit Income</h1><p>Receipt number remains unchanged for audit consistency.</p></div></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ route('incomes.update', $income) }}">@include('incomes.partials.form')</form></div></div>
@endsection
