<html><head><meta charset="UTF-8"></head><body>
<h2>XYZ School - Financial Summary</h2>
<p>Period: {{ $from }} to {{ $to }}</p>
<table border="1"><tr><th>Total Income</th><th>Total Expenses</th><th>Total Payroll</th><th>Net Profit/Loss</th></tr><tr><td>{{ $totals['income'] }}</td><td>{{ $totals['expenses'] }}</td><td>{{ $totals['payroll'] }}</td><td>{{ $totals['profit'] }}</td></tr></table>
<h3>Income</h3><table border="1"><tr><th>Receipt</th><th>Student</th><th>Fee Type</th><th>Amount</th><th>Date</th></tr>@foreach($incomes as $income)<tr><td>{{ $income->receipt_number }}</td><td>{{ $income->student_name }}</td><td>{{ $income->fee_type }}</td><td>{{ $income->amount }}</td><td>{{ $income->payment_date->format('Y-m-d') }}</td></tr>@endforeach</table>
<h3>Expenses</h3><table border="1"><tr><th>Title</th><th>Category</th><th>Amount</th><th>Date</th></tr>@foreach($expenses as $expense)<tr><td>{{ $expense->expense_title }}</td><td>{{ $expense->category }}</td><td>{{ $expense->amount }}</td><td>{{ $expense->expense_date->format('Y-m-d') }}</td></tr>@endforeach</table>
<h3>Payroll</h3><table border="1"><tr><th>Employee</th><th>Salary</th><th>Bonus</th><th>Deduction</th><th>Net Salary</th><th>Date</th></tr>@foreach($payrolls as $payroll)<tr><td>{{ $payroll->employee_name }}</td><td>{{ $payroll->salary }}</td><td>{{ $payroll->bonus }}</td><td>{{ $payroll->deduction }}</td><td>{{ $payroll->net_salary }}</td><td>{{ $payroll->payroll_date->format('Y-m-d') }}</td></tr>@endforeach</table>
</body></html>
