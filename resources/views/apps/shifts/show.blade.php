@extends('apps.layouts.main')

@section('content')

<div class="min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-4 lg:px-4">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Detail Shift</h1>
                <p class="text-slate-600">Informasi lengkap dan transaksi shift</p>
            </div>
            <a href="{{ route('apps.shifts.index') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 hover:bg-slate-50 hover:border-slate-400 transition-all duration-200 shadow-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 overflow-hidden">
            <!-- Status Header -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-white">
                        <h2 class="text-xl font-semibold">
                            Shift {{ \Carbon\Carbon::parse($shift->shift_date)->translatedFormat('d F Y') }}
                        </h2>
                        <p class="text-slate-300 text-sm mt-1">{{ $shift->user?->name ?? 'Tidak ada kasir' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                   {{ $shift->status === 'open' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-800' }}">
                            {{ ucfirst($shift->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Shift Information Grid -->
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Shift</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 p-4 rounded-xl border border-blue-200/50">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-blue-700">Tanggal</span>
                        </div>
                        <p class="text-slate-900 font-semibold">{{ \Carbon\Carbon::parse($shift->shift_date)->format('d M Y') }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 p-4 rounded-xl border border-emerald-200/50">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-emerald-700">Waktu Mulai</span>
                        </div>
                        <p class="text-slate-900 font-semibold">{{ $shift->start_time }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 p-4 rounded-xl border border-amber-200/50">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-amber-700">Waktu Selesai</span>
                        </div>
                        <p class="text-slate-900 font-semibold">{{ $shift->end_time ?? 'Belum selesai' }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100/50 p-4 rounded-xl border border-purple-200/50">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-purple-700">Kasir</span>
                        </div>
                        <p class="text-slate-900 font-semibold">{{ $shift->user?->name ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Ringkasan Keuangan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100/50 p-4 rounded-xl border border-indigo-200/50">
                        <div class="text-sm font-medium text-indigo-700 mb-1">Kas Awal</div>
                        <p class="text-xl font-bold text-slate-900">Rp {{ number_format($shift->opening_cash, 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-cyan-50 to-cyan-100/50 p-4 rounded-xl border border-cyan-200/50">
                        <div class="text-sm font-medium text-cyan-700 mb-1">Kas Akhir</div>
                        <p class="text-xl font-bold text-slate-900">
                            {{ $shift->closing_cash !== null ? 'Rp '.number_format($shift->closing_cash, 0, ',', '.') : '-' }}
                        </p>
                    </div>

                    <div class="bg-gradient-to-br from-teal-50 to-teal-100/50 p-4 rounded-xl border border-teal-200/50">
                        <div class="text-sm font-medium text-teal-700 mb-1">Total Omzet</div>
                        <p class="text-xl font-bold text-slate-900">Rp {{ number_format($shift->total_sales, 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-rose-50 to-rose-100/50 p-4 rounded-xl border border-rose-200/50">
                        <div class="text-sm font-medium text-rose-700 mb-1">Saldo Kas</div>
                        <p class="text-xl font-bold text-slate-900">Rp {{ number_format($shift->current_cash_balance, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Transactions Section -->
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-900">Transaksi</h3>
                    <span class="text-sm text-slate-500">{{ $shift->transactions->count() }} transaksi</span>
                </div>
                
                <div class="bg-slate-50 rounded-xl divide-y divide-slate-200">
                    @forelse($shift->transactions as $index => $trx)
                        <div class="p-4 flex items-center justify-between hover:bg-white transition-colors duration-150 
                                    {{ $index >= 5 ? 'transaction-item-hidden hidden' : 'transaction-item-visible' }}">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-slate-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-900">{{ $trx->transaction_code }}</div>
                                        <div class="text-sm text-slate-500">
                                            {{ $trx->created_at->format('d M Y H:i') }} • 
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                                {{ strtoupper($trx->payment_method) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mr-4">
                                <div class="font-bold text-slate-900 text-lg">Rp {{ number_format($trx->total, 0, ',', '.') }}</div>
                            </div>
                            <a href="{{ route('apps.transactions.show', $trx) }}" 
                            class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition-colors duration-150">
                                Detail
                            </a>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <svg class="w-12 h-12 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-slate-500">Belum ada transaksi pada shift ini</p>
                        </div>
                    @endforelse
                </div>

                @if($shift->transactions->count() > 5)
                    <div class="mt-4 text-center">
                        <button id="toggleTransactions" 
                                class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg text-sm font-medium transition-colors duration-150">
                            <span id="toggleText">Show All ({{ $shift->transactions->count() - 5 }} more)</span>
                            <svg id="toggleIcon" class="w-4 h-4 ml-2 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const toggleBtn = document.getElementById('toggleTransactions');
                    const toggleText = document.getElementById('toggleText');
                    const toggleIcon = document.getElementById('toggleIcon');
                    const hiddenItems = document.querySelectorAll('.transaction-item-hidden');
                    const totalTransactions = {{ $shift->transactions->count() }};
                    const hiddenCount = totalTransactions - 5;
                    
                    let isExpanded = false;
                    
                    if (toggleBtn) {
                        toggleBtn.addEventListener('click', function() {
                            isExpanded = !isExpanded;
                            
                            hiddenItems.forEach(item => {
                                if (isExpanded) {
                                    item.classList.remove('hidden');
                                } else {
                                    item.classList.add('hidden');
                                }
                            });
                            
                            if (isExpanded) {
                                toggleText.textContent = 'Hide';
                                toggleIcon.classList.add('rotate-180');
                                toggleBtn.classList.remove('bg-slate-900', 'hover:bg-slate-950');
                                toggleBtn.classList.add('bg-slate-800', 'hover:bg-slate-950');
                            } else {
                                toggleText.textContent = `Show All (${hiddenCount} more)`;
                                toggleIcon.classList.remove('rotate-180');
                                toggleBtn.classList.remove('bg-slate-600', 'hover:bg-slate-700');
                                toggleBtn.classList.add('bg-slate-900', 'hover:bg-slate-950');
                            }
                        });
                    }
                });
                </script>
            </div>

            <!-- Bottom Section: Cash Management & Reports -->
            <div class="p-6">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                    <!-- Cash Management -->
                    <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 rounded-xl p-6 border border-slate-200">
                        <h4 class="font-semibold text-slate-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Kelola Kas
                        </h4>
                        
                        <form action="{{ route('apps.shifts.cash', $shift) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <select name="type" class="border-slate-300 p-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                                    <option value="in"> Kas Masuk</option>
                                    <option value="out"> Kas Keluar</option>
                                </select>
                                <input type="number" name="amount" step="1" min="1" placeholder="Jumlah (Rp)" 
                                       class="border-slate-300 rounded-lg p-2 border border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                            <input type="text" name="notes" placeholder="Catatan (opsional)" 
                                   class="w-full border-slate-300 rounded-lg focus:border-blue-500 p-2  focus:ring-blue-500">
                            <button type="submit" 
                                    class="w-full px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-medium transition-colors duration-150 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Catat Transaksi Kas
                            </button>
                        </form>

                        <!-- Cash Movement History -->
                        <div class="mt-6">
                            <h5 class="font-medium text-slate-700 mb-3">Riwayat Pergerakan Kas</h5>
                            <div class="max-h-64 overflow-y-auto space-y-2">
                                @forelse($shift->cashMovements as $m)
                                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-slate-200">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 {{ $m->type === 'in' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }} rounded-lg flex items-center justify-center">
                                                {{ $m->type === 'in' ? '↗' : '↙' }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-slate-900 capitalize">{{ $m->type === 'in' ? 'Kas Masuk' : 'Kas Keluar' }}</div>
                                                <div class="text-xs text-slate-500">{{ $m->created_at->format('d M Y H:i') }}</div>
                                                @if($m->notes)
                                                    <div class="text-xs text-slate-600 mt-1">{{ $m->notes }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="{{ $m->type === 'in' ? 'text-emerald-700' : 'text-red-700' }} font-bold">
                                                {{ $m->type === 'in' ? '+' : '-' }} Rp {{ number_format($m->amount, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <p class="text-slate-500 text-sm">Belum ada pergerakan kas</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Reports Section -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl p-6 border border-blue-200">
                        <h4 class="font-semibold text-slate-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Laporan Shift
                        </h4>
                        
                        <div class="space-y-4">
                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <h5 class="font-medium text-slate-900 mb-2">X-Report</h5>
                                <p class="text-sm text-slate-600 mb-3">Laporan sementara tanpa menutup shift</p>
                                <a href="{{ route('apps.shifts.xreport', $shift) }}" target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors duration-150 w-full justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download X-Report
                                </a>
                            </div>
                            
                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <h5 class="font-medium text-slate-900 mb-2">Z-Report</h5>
                                <p class="text-sm text-slate-600 mb-3">Laporan final untuk menutup shift</p>
                                <a href="{{ route('apps.shifts.zreport', $shift) }}" target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg font-medium transition-colors duration-150 w-full justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download Z-Report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection