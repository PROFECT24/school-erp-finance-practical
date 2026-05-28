<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest('expense_date')->paginate(10);

        if (request()->wantsJson()) {
            return response()->json($expenses);
        }

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        abort_if(request()->wantsJson(), 404);

        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'expense_title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'expense_date' => ['required', 'date'],
        ]);
        $expense = Expense::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Expense created', 'data' => $expense], 201);
        }

        return redirect()->route('expenses.index')->with('success', 'Expense added.');
    }

    public function show(Expense $expense)
    {
        return $expense;
    }

    public function edit(Expense $expense)
    {
        abort_if(request()->wantsJson(), 404);

        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'expense_title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'expense_date' => ['required', 'date'],
        ]);
        $expense->update($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Expense updated', 'data' => $expense]);
        }

        return redirect()->route('expenses.index')->with('success', 'Expense updated.');
    }

    public function destroy(Request $request, Expense $expense)
    {
        $expense->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Expense deleted']);
        }

        return redirect()->route('expenses.index')->with('success', 'Expense deleted.');
    }
}
