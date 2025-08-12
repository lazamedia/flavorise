<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $category = $request->input('category');

        $query = Expense::with('user')->orderByDesc('expense_date');

        if ($startDate && $endDate) {
            $query->whereBetween('expense_date', [$startDate, $endDate]);
        }
        if ($category) {
            $query->where('category', $category);
        }

        $expenses = $query->paginate(12)->withQueryString();

        $total = (float) $query->clone()->sum('amount');

        return view('apps.expenses.index', compact('expenses', 'startDate', 'endDate', 'category', 'total'));
    }

    public function create()
    {
        return view('apps.expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'amount' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'in:operational,supplies,maintenance,other'],
            'expense_date' => ['required', 'date'],
            'receipt_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('receipt_image')) {
            $validated['receipt_image'] = $request->file('receipt_image')->store('expenses', 'public');
        }

        $validated['user_id'] = auth()->id() ?: optional(User::orderBy('id')->first())->id;

        Expense::create($validated);

        return redirect()->route('apps.expenses.index')->with('success', 'Pengeluaran ditambahkan.');
    }

    public function show(Expense $expense)
    {
        return view('apps.expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('apps.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'amount' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'in:operational,supplies,maintenance,other'],
            'expense_date' => ['required', 'date'],
            'receipt_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('receipt_image')) {
            if ($expense->receipt_image) {
                Storage::disk('public')->delete($expense->receipt_image);
            }
            $validated['receipt_image'] = $request->file('receipt_image')->store('expenses', 'public');
        }

        $expense->update($validated);

        return redirect()->route('apps.expenses.index')->with('success', 'Pengeluaran diperbarui.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->receipt_image) {
            Storage::disk('public')->delete($expense->receipt_image);
        }
        $expense->delete();
        return redirect()->route('apps.expenses.index')->with('success', 'Pengeluaran dihapus.');
    }
}


