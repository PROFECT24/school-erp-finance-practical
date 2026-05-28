<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@school.test'],
            ['name' => 'School Admin', 'password' => Hash::make('password')]
        );

        Income::updateOrCreate(['receipt_number' => 'RCPT-202605-00001'], [
            'student_name' => 'Aarav Sharma',
            'fee_type' => 'Tuition Fee',
            'amount' => 45000,
            'payment_date' => '2026-05-05',
        ]);
        Income::updateOrCreate(['receipt_number' => 'RCPT-202605-00002'], [
            'student_name' => 'Diya Mehta',
            'fee_type' => 'Transport Fee',
            'amount' => 12000,
            'payment_date' => '2026-05-08',
        ]);
        Income::updateOrCreate(['receipt_number' => 'RCPT-202605-00003'], [
            'student_name' => 'Kabir Rao',
            'fee_type' => 'Exam Fee',
            'amount' => 6500,
            'payment_date' => '2026-05-14',
        ]);

        Expense::updateOrCreate(['expense_title' => 'Electricity Bill', 'expense_date' => '2026-05-10'], [
            'category' => 'Utilities',
            'amount' => 8500,
        ]);
        Expense::updateOrCreate(['expense_title' => 'Classroom Stationery', 'expense_date' => '2026-05-12'], [
            'category' => 'Stationery',
            'amount' => 4300,
        ]);
        Expense::updateOrCreate(['expense_title' => 'Computer Lab Maintenance', 'expense_date' => '2026-05-16'], [
            'category' => 'Maintenance',
            'amount' => 15000,
        ]);

        Payroll::updateOrCreate(['employee_name' => 'Neha Kapoor', 'payroll_date' => '2026-05-25'], [
            'salary' => 35000,
            'bonus' => 2500,
            'deduction' => 1500,
            'net_salary' => 36000,
        ]);
        Payroll::updateOrCreate(['employee_name' => 'Rohan Das', 'payroll_date' => '2026-05-25'], [
            'salary' => 28000,
            'bonus' => 1000,
            'deduction' => 1200,
            'net_salary' => 27800,
        ]);
    }
}
