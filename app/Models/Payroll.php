<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_name',
        'salary',
        'bonus',
        'deduction',
        'net_salary',
        'payroll_date',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deduction' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'payroll_date' => 'date',
    ];

    public static function calculateNetSalary(float $salary, float $bonus, float $deduction): float
    {
        return $salary + $bonus - $deduction;
    }
}
