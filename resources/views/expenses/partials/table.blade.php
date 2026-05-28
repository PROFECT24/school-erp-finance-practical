<div class="table-wrap"><table class="data-table"><thead><tr><th>Title</th><th>Category</th><th>Amount</th><th>Date</th>@empty($compact)<th>Actions</th>@endempty</tr></thead><tbody>
@forelse($expenses as $expense)
<tr><td style="font-weight:600;">{{ $expense->expense_title }}</td><td>{{ $expense->category }}</td><td style="font-family:var(--mono);color:var(--danger);font-weight:700;">{{ number_format($expense->amount, 2) }}</td><td>{{ $expense->expense_date->format('d M Y') }}</td>
@empty($compact)<td style="display:flex;gap:6px;"><a class="btn btn-outline btn-sm" href="{{ route('expenses.edit', $expense) }}"><i class="fa-solid fa-pen"></i></a><form method="POST" action="{{ route('expenses.destroy', $expense) }}">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" onclick="return confirm('Delete expense?')"><i class="fa-solid fa-trash"></i></button></form></td>@endempty</tr>
@empty
<tr><td colspan="5" style="text-align:center;color:var(--text-muted);">No expenses yet.</td></tr>
@endforelse
</tbody></table></div>
