@extends('apps.layouts.main')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Transaksi</h1>
    </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="relative">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pencarian</label>
                    <input type="text" name="q" value="{{ request('q') }}" 
                           placeholder="Cari kode atau catatan..." 
                           class="w-full border border-slate-300 p-2 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pembayaran</label>
                    <select name="payment_method" class="w-full border border-slate-300 p-2 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Semua Metode</option>
                        <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}> Tunai</option>
                        <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}> QRIS</option>
                    </select>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-slate-300 p-2 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Semua Status</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}> Selesai</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}> Pending</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}> Batal</option>
                    </select>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                    <input type="date" name="date" value="{{ request('date') }}" 
                           class="w-full border border-slate-300 p-2 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div class="flex items-end">
                    <button type="submit" 
                            class="w-full px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-medium transition-colors duration-150 text-sm">
                            Filter
                    </button>
                </div>
            </form>
        </div>
    <!-- Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kasir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pembayaran</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($transactions as $trx)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $trx->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-3 text-sm font-medium text-gray-800">{{ $trx->transaction_code }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $trx->user?->name ?? '-' }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700 uppercase">{{ $trx->payment_method }}</td>
                        <td class="px-6 py-3 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format($trx->total, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-right">
                            <a href="{{ route('apps.transactions.show', $trx) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div>
        {{ $transactions->links() }}
    </div>
</div>
@endsection
