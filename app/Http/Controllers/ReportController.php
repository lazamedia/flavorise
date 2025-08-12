<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {
            $startDate = now()->startOfMonth()->toDateString();
            $endDate = now()->toDateString();
        }

        $transactionsQuery = Transaction::query()
            ->whereBetween('created_at', [\Carbon\Carbon::parse($startDate)->startOfDay(), \Carbon\Carbon::parse($endDate)->endOfDay()])
            ->orderByDesc('created_at');

        $transactions = $transactionsQuery->paginate(15)->withQueryString();

        $summary = [
            'total_sales' => (float) $transactionsQuery->clone()->sum('total'),
            'transaction_count' => (int) $transactionsQuery->clone()->count(),
        ];
        $summary['avg_ticket'] = $summary['transaction_count'] > 0
            ? $summary['total_sales'] / $summary['transaction_count']
            : 0;

        $byPayment = Transaction::select('payment_method', DB::raw('SUM(total) as total'))
            ->whereBetween('created_at', [\Carbon\Carbon::parse($startDate)->startOfDay(), \Carbon\Carbon::parse($endDate)->endOfDay()])
            ->groupBy('payment_method')
            ->pluck('total', 'payment_method')
            ->toArray();

        $byCategory = TransactionItem::query()
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->join('menus', 'transaction_items.menu_id', '=', 'menus.id')
            ->join('categories', 'menus.category_id', '=', 'categories.id')
            ->whereBetween('transactions.created_at', [\Carbon\Carbon::parse($startDate)->startOfDay(), \Carbon\Carbon::parse($endDate)->endOfDay()])
            ->groupBy('categories.id', 'categories.name')
            ->select('categories.name as category_label', DB::raw('SUM(transaction_items.total_price) as total'))
            ->orderByDesc('total')
            ->get();

        $topMenus = TransactionItem::query()
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->join('menus', 'transaction_items.menu_id', '=', 'menus.id')
            ->whereBetween('transactions.created_at', [\Carbon\Carbon::parse($startDate)->startOfDay(), \Carbon\Carbon::parse($endDate)->endOfDay()])
            ->groupBy('menus.id', 'menus.name')
            ->select('menus.name as product_name', DB::raw('SUM(transaction_items.quantity) as qty'), DB::raw('SUM(transaction_items.total_price) as total'))
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $daily = Transaction::query()
            ->whereBetween('created_at', [\Carbon\Carbon::parse($startDate)->startOfDay(), \Carbon\Carbon::parse($endDate)->endOfDay()])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->orderBy('date')
            ->get();

        // CSV export
        if ($request->get('export') === 'csv') {
            $rows = [
                ['Tanggal', 'Kode', 'Metode', 'Total']
            ];
            foreach ($transactionsQuery->clone()->orderBy('created_at')->cursor() as $trx) {
                $rows[] = [
                    $trx->created_at->format('Y-m-d H:i'),
                    $trx->transaction_code,
                    strtoupper($trx->payment_method),
                    (string) $trx->total,
                ];
            }
            $handle = fopen('php://temp', 'r+');
            foreach ($rows as $row) { fputcsv($handle, $row); }
            rewind($handle);
            $csv = stream_get_contents($handle);
            fclose($handle);
            return response($csv, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="sales-report.csv"'
            ]);
        }

        // Total expenses and profit
        $totalExpenses = \App\Models\Expense::getTotalByPeriod($startDate, $endDate);
        $profit = $summary['total_sales'] - $totalExpenses;

        return view('apps.reports.sales', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'transactions' => $transactions,
            'summary' => $summary,
            'byPayment' => $byPayment,
            'byCategory' => $byCategory,
            'topMenus' => $topMenus,
            'daily' => $daily,
            'totalExpenses' => $totalExpenses,
            'profit' => $profit,
        ]);
    }
}


