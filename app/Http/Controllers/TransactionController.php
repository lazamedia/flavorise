<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'shift'])
            ->orderByDesc('created_at');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('transaction_code', 'like', '%'.$q.'%')
                    ->orWhere('customer_notes', 'like', '%'.$q.'%');
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $transactions = $query->paginate(12)->withQueryString();

        return view('apps.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['items.menu.category', 'user', 'shift']);
        return view('apps.transactions.show', compact('transaction'));
    }

    public function print(Transaction $transaction)
    {
        $transaction->load(['items.menu.category', 'user', 'shift']);
        return view('apps.transactions.print', compact('transaction'));
    }

    public function void(Transaction $transaction)
    {
        if ($transaction->status === 'cancelled') {
            return back()->with('success', 'Transaksi sudah dibatalkan.');
        }

        foreach ($transaction->items as $item) {
            // restock
            if ($item->menu) {
                $item->menu->stock += $item->quantity;
                $item->menu->save();
            }
        }

        $transaction->status = 'cancelled';
        $transaction->save();

        if ($transaction->shift) {
            $transaction->shift->calculateTotalSales();
        }

        return redirect()->route('apps.transactions.show', $transaction)->with('success', 'Transaksi dibatalkan dan stok dikembalikan.');
    }
}


