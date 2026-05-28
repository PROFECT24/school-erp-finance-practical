@extends('layouts.app')
@section('page-title', 'Add Income')
@section('content')
<div class="page-header"><div><h1>Add Income</h1><p>Generate receipt number automatically after save.</p></div></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ route('incomes.store') }}">@include('incomes.partials.form')</form></div></div>
@endsection
