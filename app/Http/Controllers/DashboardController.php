<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Shift;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();

        $todaySales = (float) Transaction::whereBetween('created_at', [$todayStart, $todayEnd])->sum('total');
        $todayCount = (int) Transaction::whereBetween('created_at', [$todayStart, $todayEnd])->count();
        $monthSales = (float) Transaction::whereBetween('created_at', [$monthStart, $monthEnd])->sum('total');
        $monthExpenses = (float) Expense::whereBetween('expense_date', [$monthStart->toDateString(), $monthEnd->toDateString()])->sum('amount');
        $monthProfit = $monthSales - $monthExpenses;

        $byPaymentToday = Transaction::select('payment_method', DB::raw('SUM(total) as total'))
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->groupBy('payment_method')->pluck('total', 'payment_method')->toArray();

        $byPaymentTodayCount = Transaction::select('payment_method', DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->groupBy('payment_method')
            ->pluck('count', 'payment_method')
            ->toArray();

        $topMenus = DB::table('transaction_items')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->join('menus', 'transaction_items.menu_id', '=', 'menus.id')
            ->whereBetween('transactions.created_at', [$monthStart, $monthEnd])
            ->groupBy('menus.id', 'menus.name')
            ->select('menus.name as product_name', DB::raw('SUM(transaction_items.quantity) as qty'))
            ->orderByDesc('qty')->limit(5)->get();

        $last7Start = now()->subDays(6)->startOfDay();
        $last7End = now()->endOfDay();
        $bestDay = Transaction::whereBetween('created_at', [$last7Start, $last7End])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->orderByDesc('total')->first();

        $dailySeries = Transaction::whereBetween('created_at', [$last7Start, $last7End])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->orderBy('date')->get();

        $shiftsToday = Transaction::whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
        ->with('shift.user') // pastikan relasi shift->user ada
        ->get()
        ->groupBy(function ($trx) {
            return optional($trx->shift->user)->id;
        })
        ->map(function ($transactions, $userId) {
            $userName = optional($transactions->first()->shift->user)->name ?? 'Tidak diketahui';
            $totalSales = $transactions->sum('total');
            return [
                'user' => $userName,
                'sales' => $totalSales
            ];
        })
        ->values();
        

        $activeShifts = Shift::active()->count();
        $lowStockMenus = Menu::where('stock', '<=', 5)->orderBy('stock')->limit(5)->get(['id','name','stock']);

        return view('apps.dashboard', compact(
            'todaySales','todayCount','monthSales','monthProfit',
            'byPaymentToday','topMenus','activeShifts','lowStockMenus',
            'bestDay','dailySeries','shiftsToday','byPaymentTodayCount'
        ));
    }
}


