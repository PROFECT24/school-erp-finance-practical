@csrf
@if(isset($expense)) @method('PUT') @endif
<div class="grid-2">
    <div class="form-group"><label>Expense Title</label><input class="form-control" name="expense_title" value="{{ old('expense_title', $expense->expense_title ?? '') }}" required></div>
    <div class="form-group"><label>Category</label><input class="form-control" name="category" value="{{ old('category', $expense->category ?? '') }}" placeholder="Utilities" required></div>
    <div class="form-group"><label>Amount</label><input class="form-control" type="number" step="0.01" min="0" name="amount" value="{{ old('amount', $expense->amount ?? '') }}" required></div>
    <div class="form-group"><label>Expense Date</label><input class="form-control" type="date" name="expense_date" value="{{ old('expense_date', isset($expense) ? $expense->expense_date->format('Y-m-d') : now()->toDateString()) }}" required></div>
</div>
<div style="display:flex;gap:10px;justify-content:flex-end;margin-top:16px;"><a class="btn btn-outline" href="{{ route('expenses.index') }}">Cancel</a><button class="btn btn-primary"><i class="fa-solid fa-check"></i> Save Expense</button></div>
