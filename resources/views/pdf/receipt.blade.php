<!DOCTYPE html>
<html><head><meta charset="UTF-8"><style>
body{font-family:DejaVu Sans,Arial,sans-serif;color:#111827;font-size:13px}.sheet{border:2px solid #1a7a4a;padding:28px}.head{text-align:center;border-bottom:2px solid #1a7a4a;padding-bottom:14px;margin-bottom:22px}.school{font-size:24px;font-weight:800;color:#1a7a4a}.muted{color:#6b7280}.badge{display:inline-block;background:#e8f5ee;color:#1a7a4a;padding:6px 12px;border-radius:16px;font-weight:700;margin-top:8px}table{width:100%;border-collapse:collapse;margin:22px 0}td{padding:12px;border-bottom:1px solid #e5e7eb}.label{font-weight:700;color:#374151;width:35%}.amount{font-size:24px;font-weight:800;color:#1a7a4a}.footer{margin-top:40px;display:table;width:100%}.sign{display:table-cell;width:50%;padding-top:36px;border-top:1px solid #9ca3af}.right{text-align:right}.note{background:#f9fafb;border:1px solid #e5e7eb;padding:12px;margin-top:24px}
</style></head><body>
<div class="sheet">
    <div class="head">
        <div class="school">XYZ School</div>
        <div class="muted">Official Fee Receipt</div>
        <div class="badge">{{ $income->receipt_number }}</div>
    </div>
    <table>
        <tr><td class="label">Student Name</td><td>{{ $income->student_name }}</td></tr>
        <tr><td class="label">Fee Type</td><td>{{ $income->fee_type }}</td></tr>
        <tr><td class="label">Payment Date</td><td>{{ $income->payment_date->format('d M Y') }}</td></tr>
        <tr><td class="label">Amount Paid</td><td class="amount">INR {{ number_format($income->amount, 2) }}</td></tr>
    </table>
    <div class="note">Received with thanks. This receipt was generated from the SchoolERP finance module.</div>
    <div class="footer">
        <div class="sign">Accountant Signature</div>
        <div class="sign right">School Seal / Authorised Signatory</div>
    </div>
</div>
</body></html>
