<div class="table-wrap"><table class="data-table"><thead><tr><th>Employee</th><th>Salary</th><th>Bonus</th><th>Deduction</th><th>Net Salary</th><th>Date</th>@empty($compact)<th>Actions</th>@endempty</tr></thead><tbody>
@forelse($payrolls as $payroll)
<tr><td style="font-weight:600;">{{ $payroll->employee_name }}</td><td style="font-family:var(--mono);">{{ number_format($payroll->salary, 2) }}</td><td style="font-family:var(--mono);color:var(--primary);">{{ number_format($payroll->bonus, 2) }}</td><td style="font-family:var(--mono);color:var(--danger);">{{ number_format($payroll->deduction, 2) }}</td><td style="font-family:var(--mono);font-weight:800;color:var(--primary);">{{ number_format($payroll->net_salary, 2) }}</td><td>{{ $payroll->payroll_date->format('d M Y') }}</td>
@empty($compact)<td style="display:flex;gap:6px;"><a class="btn btn-outline btn-sm" href="{{ route('payrolls.edit', $payroll) }}"><i class="fa-solid fa-pen"></i></a><form method="POST" action="{{ route('payrolls.destroy', $payroll) }}">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" onclick="return confirm('Delete payroll?')"><i class="fa-solid fa-trash"></i></button></form></td>@endempty</tr>
@empty
<tr><td colspan="7" style="text-align:center;color:var(--text-muted);">No payroll entries yet.</td></tr>
@endforelse
</tbody></table></div>
