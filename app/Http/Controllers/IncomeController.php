<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::latest('payment_date')->paginate(10);

        if (request()->wantsJson()) {
            return response()->json($incomes);
        }

        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        abort_if(request()->wantsJson(), 404);

        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'fee_type' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_date' => ['required', 'date'],
        ]);

        $data['receipt_number'] = $this->nextReceiptNumber();
        $income = Income::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Income created', 'data' => $income], 201);
        }

        return redirect()->route('incomes.index')->with('success', 'Income added. Receipt is ready to download.');
    }

    public function show(Income $income)
    {
        return $income;
    }

    public function edit(Income $income)
    {
        abort_if(request()->wantsJson(), 404);

        return view('incomes.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        $data = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'fee_type' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_date' => ['required', 'date'],
        ]);
        $income->update($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Income updated', 'data' => $income]);
        }

        return redirect()->route('incomes.index')->with('success', 'Income updated.');
    }

    public function destroy(Request $request, Income $income)
    {
        $income->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Income deleted']);
        }

        return redirect()->route('incomes.index')->with('success', 'Income deleted.');
    }

    public function receipt(Income $income)
    {
        return Pdf::loadView('pdf.receipt', compact('income'))
            ->setPaper('a4')
            ->download("receipt-{$income->receipt_number}.pdf");
    }

    private function nextReceiptNumber(): string
    {
        $nextId = (Income::max('id') ?? 0) + 1;

        return 'RCPT-' . now()->format('Ym') . '-' . str_pad((string) $nextId, 5, '0', STR_PAD_LEFT);
    }
}
