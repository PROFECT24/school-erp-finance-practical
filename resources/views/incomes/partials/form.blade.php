@csrf
@if(isset($income)) @method('PUT') @endif
<div class="grid-2">
    <div class="form-group"><label>Student Name</label><input class="form-control" name="student_name" value="{{ old('student_name', $income->student_name ?? '') }}" required></div>
    <div class="form-group"><label>Fee Type</label><input class="form-control" name="fee_type" value="{{ old('fee_type', $income->fee_type ?? '') }}" placeholder="Tuition Fee" required></div>
    <div class="form-group"><label>Amount</label><input class="form-control" type="number" step="0.01" min="0" name="amount" value="{{ old('amount', $income->amount ?? '') }}" required></div>
    <div class="form-group"><label>Payment Date</label><input class="form-control" type="date" name="payment_date" value="{{ old('payment_date', isset($income) ? $income->payment_date->format('Y-m-d') : now()->toDateString()) }}" required></div>
</div>
<div style="display:flex;gap:10px;justify-content:flex-end;margin-top:16px;">
    <a class="btn btn-outline" href="{{ route('incomes.index') }}">Cancel</a>
    <button class="btn btn-primary"><i class="fa-solid fa-check"></i> Save Income</button>
</div>
