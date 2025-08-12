@extends('apps.layouts.main')

@section('content')
<div class="max-w-lg mx-auto py-10">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Tutup Shift</h1>
        <a href="{{ route('apps.shifts.index') }}" 
           class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl p-8 border border-gray-100">
        <!-- Info Shift -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 text-sm">
            <!-- <div class="p-4 bg-gray-50 rounded-lg text-center">
                <div class="text-gray-500">Tanggal</div>
                <div class="font-semibold text-gray-800">{{ $shift->shift_date }}</div>
            </div> -->
            <div class="p-4 bg-gray-50 rounded-lg text-center">
                <div class="text-gray-500">Mulai Shift</div>
                <div class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</div>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg text-center">
                <div class="text-gray-500">Total Saldo + Kas Awal</div>
                <!-- <div class="font-semibold text-green-600">Rp {{ number_format($shift->total_sales, 0, ',', '.') }}</div> -->
                <div class="font-semibold text-green-600">Rp {{ number_format($shift->current_cash_balance, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Form Tutup Shift -->
        <form action="{{ route('apps.shifts.close', $shift) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Kas Akhir -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kas Akhir</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">Rp</span>
                    <input type="number" 
                           name="closing_cash" 
                           step="0.01" min="0"
                           placeholder="0"
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                           required>
                </div>
                @error('closing_cash')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea name="notes" 
                          rows="3"
                          placeholder="Tambahkan catatan penutupan shift..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition resize-none"></textarea>
                @error('notes')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-2 divide-y">
                @forelse($shift->cashMovements as $m)
                    <div class="py-2 flex justify-between text-sm">
                        <span>{{ ucfirst($m->type) }} • {{ $m->notes }}</span>
                        <span class="{{ $m->type==='in' ? 'text-green-700' : 'text-red-700' }} font-semibold">
                            {{ $m->type==='in' ? '+' : '-' }} Rp {{ number_format($m->amount, 0, ',', '.') }}
                        </span>
                    </div>
                @empty
                    <p class="py-2 text-sm text-gray-500">Belum ada catatan.</p>
                @endforelse
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-2">
                <a href="{{ route('apps.shifts.index') }}" 
                   class="flex-1 px-4 py-3 text-center border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Tutup Shift
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
