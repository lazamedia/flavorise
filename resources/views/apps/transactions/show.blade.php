@extends('apps.layouts.main')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Detail Transaksi</h1>
        <a href="{{ route('apps.transactions.index') }}" 
           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg shadow-sm transition">
           Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 space-y-6">
<!-- Info Utama -->
<div class="bg-white rounded-2xl shadow-md p-5">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Info Transaksi</h3>
    <div class="grid grid-cols-2 gap-y-4 gap-x-6">
        
        <!-- Kode Transaksi -->
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Kode Transaksi</p>
            <p class="text-base font-semibold text-gray-900">
                {{ $transaction->transaction_code }}
            </p>
        </div>

        <!-- Tanggal -->
        <div class="text-right">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Tanggal</p>
            <p class="text-base font-semibold text-gray-900">
                {{ $transaction->created_at->format('d M Y H:i') }}
            </p>
        </div>

        <!-- Kasir -->
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Kasir</p>
            <p class="text-gray-800">
                {{ $transaction->user?->name ?? '-' }}
            </p>
        </div>

        <!-- Metode Pembayaran -->
        <div class="text-right">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Metode Pembayaran</p>
            <p class="text-gray-800 uppercase">
                {{ $transaction->payment_method }}
            </p>
        </div>

    </div>
</div>


        {{-- <!-- Daftar Item -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Daftar Item</h3>
            <div class="divide-y">
                @foreach($transaction->items as $item)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">{{ $item->menu->name }}</p>
                            <p class="text-xs text-gray-500">{{ $item->quantity }} × Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-semibold text-gray-900">Rp {{ number_format($item->total_price, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div> --}}

        <!-- Daftar Item -->
        <div class="bg-white rounded-2xl shadow-md p-5">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Daftar Item</h3>
            <div class="divide-y">
                @foreach($transaction->items as $item)
                    <div class="py-3 flex items-center justify-between hover:bg-gray-50 transition duration-200 rounded-lg px-2">
                        <!-- Info Menu -->
                        <div>
                            <p class="font-medium text-gray-900">{{ $item->menu->name }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $item->quantity }} × Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                            </p>
                        </div>
                        <!-- Total -->
                        <p class="font-semibold text-gray-900">
                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-4 p-4">
            <!-- Subtotal -->
            <div class="bg-gray-100 rounded-lg p-3 flex justify-between items-center text-sm">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-semibold text-gray-800">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
            </div>

            <!-- Diskon -->
            <div class="bg-gray-100 rounded-lg p-3 flex justify-between items-center text-sm">
                <span class="text-gray-600">Diskon</span>
                <span class="font-semibold text-red-500">- Rp {{ number_format($transaction->discount, 0, ',', '.') }}</span>
            </div>

            <!-- Pajak -->
            <div class="bg-gray-100 rounded-lg p-3 flex justify-between items-center text-sm">
                <span class="text-gray-600">Pajak</span>
                <span class="font-semibold text-gray-800">Rp {{ number_format($transaction->tax, 0, ',', '.') }}</span>
            </div>
        </div>


        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-6 p-2">
            <!-- Total -->
            <div class="rounded-2xl border-2 border-dashed border-gray-400 shadow-lg overflow-hidden hover:border-slate-500 transition duration-300">
                <div class="bg-gray-100 text-gray-700 text-sm font-medium px-4 py-2 border-b border-gray-300">
                    Total
                </div>
                <div class="bg-white p-6 flex justify-center items-center">
                    <span class="text-3xl font-bold text-slate-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Uang Diterima -->
            <div class="rounded-2xl border-2 border-dashed border-gray-400 shadow-lg overflow-hidden hover:border-gray-500 transition duration-300">
                <div class="bg-gray-100 text-gray-700 text-sm font-medium px-4 py-2 border-b border-gray-300">
                    Uang Diterima
                </div>
                <div class="bg-white p-6 flex justify-center items-center">
                    <span class="text-3xl font-bold text-gray-600">Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Kembalian -->
            <div class="rounded-2xl border-2 border-dashed border-gray-400 shadow-lg overflow-hidden hover:border-green-500 transition duration-300">
                <div class="bg-gray-100 text-gray-700 text-sm font-medium px-4 py-2 border-b border-gray-300">
                    Kembalian
                </div>
                <div class="bg-white p-6 flex justify-center items-center">
                    <span class="text-3xl font-bold text-green-600">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>


        <!-- Catatan -->
        <div>
            <p class="text-xs text-gray-500">Catatan</p>
            <p class="text-gray-800">{{ $transaction->customer_notes ?: '-' }}</p>
        </div>

        <!-- Aksi -->
        <div class="pt-4 flex gap-3">
            <a href="{{ route('apps.transactions.print', $transaction) }}" target="_blank" 
               class="px-4 py-2 bg-gray-900 hover:bg-black text-white rounded-lg shadow-sm transition">
               Cetak
            </a>
            @if($transaction->status !== 'cancelled')
                <form action="{{ route('apps.transactions.void', $transaction) }}" method="POST" 
                      onsubmit="return confirm('Batalkan transaksi ini? Stok akan dikembalikan.')">
                    @csrf
                    <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-sm transition">
                        Batalkan Transaksi
                    </button>
                </form>
            @else
                <span class="px-4 py-2 rounded-lg bg-gray-100 text-gray-600">Sudah dibatalkan</span>
            @endif
        </div>
    </div>
</div>
@endsection
