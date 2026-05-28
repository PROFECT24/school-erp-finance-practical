@extends('layouts.app')
@section('page-title', 'Edit Payroll')
@section('content')
<div class="page-header"><div><h1>Edit Payroll</h1><p>Net salary recalculates when the record is updated.</p></div></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ route('payrolls.update', $payroll) }}">@include('payrolls.partials.form')</form></div></div>
@endsection
