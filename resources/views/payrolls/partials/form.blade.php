@csrf
@if(isset($payroll)) @method('PUT') @endif
<div class="grid-2">
    <div class="form-group"><label>Employee Name</label><input class="form-control" name="employee_name" value="{{ old('employee_name', $payroll->employee_name ?? '') }}" required></div>
    <div class="form-group"><label>Payroll Date</label><input class="form-control" type="date" name="payroll_date" value="{{ old('payroll_date', isset($payroll) ? $payroll->payroll_date->format('Y-m-d') : now()->toDateString()) }}" required></div>
    <div class="form-group"><label>Salary</label><input class="form-control payroll-input" type="number" step="0.01" min="0" name="salary" value="{{ old('salary', $payroll->salary ?? 0) }}" required></div>
    <div class="form-group"><label>Bonus</label><input class="form-control payroll-input" type="number" step="0.01" min="0" name="bonus" value="{{ old('bonus', $payroll->bonus ?? 0) }}"></div>
    <div class="form-group"><label>Deduction</label><input class="form-control payroll-input" type="number" step="0.01" min="0" name="deduction" value="{{ old('deduction', $payroll->deduction ?? 0) }}"></div>
    <div class="form-group"><label>Net Salary</label><input class="form-control" id="netSalaryPreview" value="0.00" readonly></div>
</div>
<div style="display:flex;gap:10px;justify-content:flex-end;margin-top:16px;"><a class="btn btn-outline" href="{{ route('payrolls.index') }}">Cancel</a><button class="btn btn-primary"><i class="fa-solid fa-check"></i> Save Payroll</button></div>
<script>
document.querySelectorAll('.payroll-input').forEach(input => input.addEventListener('input', calculateNet));
function calculateNet() {
    const salary = Number(document.querySelector('[name=salary]').value || 0);
    const bonus = Number(document.querySelector('[name=bonus]').value || 0);
    const deduction = Number(document.querySelector('[name=deduction]').value || 0);
    document.getElementById('netSalaryPreview').value = (salary + bonus - deduction).toFixed(2);
}
calculateNet();
</script>
