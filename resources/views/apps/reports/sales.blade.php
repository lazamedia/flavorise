@extends('apps.layouts.main')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Penjualan</h1>
    </div>

    <form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-5 gap-3">
        <div>
            <label class="block text-xs text-gray-500">Dari</label>
            <input type="date" name="start_date" value="{{ $startDate }}" class="p-2 border mt-2 border-gray-300 rounded-lg w-full" />
        </div>
        <div>
            <label class="block text-xs text-gray-500">Sampai</label>
            <input type="date" name="end_date" value="{{ $endDate }}" class="p-2 border mt-2 border-gray-300 rounded-lg w-full" />
        </div>
        <div class="md:col-span-3 flex items-end">
            <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg mr-2">Terapkan</button>
            <a href="{{ route('apps.reports.sales', array_filter(array_merge(request()->all(), ['export'=>'csv']))) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">Export CSV</a>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-500">Omzet</div>
            <div class="text-2xl font-bold">Rp {{ number_format($summary['total_sales'], 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-500">Jumlah Transaksi</div>
            <div class="text-2xl font-bold">{{ $summary['transaction_count'] }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-500">Rata-rata Transaksi</div>
            <div class="text-2xl font-bold">Rp {{ number_format($summary['avg_ticket'], 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Pengeluaran</div>
            <div class="text-2xl font-bold text-red-700">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-500">Profit (Omzet - Expenses)</div>
            <div class="text-2xl font-bold text-green-700">Rp {{ number_format($profit, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold text-gray-800 mb-3">Per Metode Pembayaran</h3>
            <div class="space-y-2">
                <div class="flex items-center justify-between"><span>Tunai</span><span class="font-semibold">Rp {{ number_format($byPayment['cash'] ?? 0, 0, ',', '.') }}</span></div>
                <div class="flex items-center justify-between"><span>QRIS</span><span class="font-semibold">Rp {{ number_format($byPayment['qris'] ?? 0, 0, ',', '.') }}</span></div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold text-gray-800 mb-3">Per Kategori</h3>
            <div class="space-y-2">
                @forelse($byCategory as $row)
                    <div class="flex items-center justify-between"><span>{{ $row->category_label }}</span><span class="font-semibold">Rp {{ number_format($row->total, 0, ',', '.') }}</span></div>
                @empty
                    <div class="text-sm text-gray-500">Tidak ada data.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h3 class="font-semibold text-gray-800 mb-3">Top Produk</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($topMenus as $row)
                        <tr>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $row->product_name }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $row->qty }}</td>
                            <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Rp {{ number_format($row->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-500">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-semibold text-gray-800 mb-3">Tren Harian</h3>
        <div class="space-y-1">
            @forelse($daily as $row)
                <div class="flex items-center justify-between"><span>{{ $row->date }}</span><span class="font-semibold">Rp {{ number_format($row->total, 0, ',', '.') }}</span></div>
            @empty
                <div class="text-sm text-gray-500">Tidak ada data.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection


