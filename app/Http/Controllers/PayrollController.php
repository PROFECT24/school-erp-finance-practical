<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::latest('payroll_date')->paginate(10);

        if (request()->wantsJson()) {
            return response()->json($payrolls);
        }

        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        abort_if(request()->wantsJson(), 404);

        return view('payrolls.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['net_salary'] = Payroll::calculateNetSalary((float) $data['salary'], (float) $data['bonus'], (float) $data['deduction']);
        $payroll = Payroll::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Payroll created', 'data' => $payroll], 201);
        }

        return redirect()->route('payrolls.index')->with('success', 'Payroll added.');
    }

    public function show(Payroll $payroll)
    {
        return $payroll;
    }

    public function edit(Payroll $payroll)
    {
        abort_if(request()->wantsJson(), 404);

        return view('payrolls.edit', compact('payroll'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $data = $this->validated($request);
        $data['net_salary'] = Payroll::calculateNetSalary((float) $data['salary'], (float) $data['bonus'], (float) $data['deduction']);
        $payroll->update($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Payroll updated', 'data' => $payroll]);
        }

        return redirect()->route('payrolls.index')->with('success', 'Payroll updated.');
    }

    public function destroy(Request $request, Payroll $payroll)
    {
        $payroll->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Payroll deleted']);
        }

        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'employee_name' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'numeric', 'min:0'],
            'bonus' => ['nullable', 'numeric', 'min:0'],
            'deduction' => ['nullable', 'numeric', 'min:0'],
            'payroll_date' => ['required', 'date'],
        ]) + ['bonus' => 0, 'deduction' => 0];
    }
}
