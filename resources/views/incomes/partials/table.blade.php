<div class="table-wrap">
<table class="data-table">
    <thead><tr><th>Receipt</th><th>Student</th><th>Fee Type</th><th>Amount</th><th>Payment Date</th>@empty($compact)<th>Actions</th>@endempty</tr></thead>
    <tbody>
    @forelse($incomes as $income)
        <tr>
            <td style="font-family:var(--mono);">{{ $income->receipt_number }}</td>
            <td style="font-weight:600;">{{ $income->student_name }}</td>
            <td>{{ $income->fee_type }}</td>
            <td style="font-family:var(--mono);color:var(--primary);font-weight:700;">{{ number_format($income->amount, 2) }}</td>
            <td>{{ $income->payment_date->format('d M Y') }}</td>
            @empty($compact)
            <td style="display:flex;gap:6px;">
                <a class="btn btn-outline btn-sm" href="{{ route('incomes.receipt', $income) }}"><i class="fa-solid fa-file-pdf"></i></a>
                <a class="btn btn-outline btn-sm" href="{{ route('incomes.edit', $income) }}"><i class="fa-solid fa-pen"></i></a>
                <form method="POST" action="{{ route('incomes.destroy', $income) }}">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" onclick="return confirm('Delete income?')"><i class="fa-solid fa-trash"></i></button></form>
            </td>
            @endempty
        </tr>
    @empty
        <tr><td colspan="6" style="text-align:center;color:var(--text-muted);">No income entries yet.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
