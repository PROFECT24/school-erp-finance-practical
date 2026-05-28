@extends('layouts.app')
@section('page-title', 'Add Payroll')
@section('content')
<div class="page-header"><div><h1>Add Payroll</h1><p>The net salary is calculated on screen and saved in Laravel.</p></div></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ route('payrolls.store') }}">@include('payrolls.partials.form')</form></div></div>
@endsection
