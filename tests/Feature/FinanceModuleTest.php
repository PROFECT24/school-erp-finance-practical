<?php

namespace Tests\Feature;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FinanceModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_finance_pages_and_exports_load(): void
    {
        $user = User::factory()->create();
        Income::create(['receipt_number' => 'RCPT-TEST-00001', 'student_name' => 'Test Student', 'fee_type' => 'Tuition', 'amount' => 1000, 'payment_date' => '2026-05-01']);
        Expense::create(['expense_title' => 'Books', 'category' => 'Stationery', 'amount' => 200, 'expense_date' => '2026-05-02']);
        Payroll::create(['employee_name' => 'Teacher One', 'salary' => 500, 'bonus' => 50, 'deduction' => 25, 'net_salary' => 525, 'payroll_date' => '2026-05-03']);

        $this->actingAs($user)->get('/')->assertOk()->assertSee('Net Profit/Loss');
        $this->actingAs($user)->get('/incomes')->assertOk()->assertSee('RCPT-TEST-00001');
        $this->actingAs($user)->get('/expenses')->assertOk()->assertSee('Books');
        $this->actingAs($user)->get('/payrolls')->assertOk()->assertSee('Teacher One');
        $this->actingAs($user)->get('/reports?from=2026-05-01&to=2026-05-31')->assertOk()->assertSee('Financial Summary');
        $this->actingAs($user)->get('/api/reports?from=2026-05-01&to=2026-05-31', ['Accept' => 'application/json'])->assertOk()->assertJsonPath('data.totals.profit', 275);
        $this->actingAs($user)->get('/reports/excel?from=2026-05-01&to=2026-05-31')->assertOk();
        $this->actingAs($user)->get('/reports/pdf?from=2026-05-01&to=2026-05-31')->assertOk();
    }
}
