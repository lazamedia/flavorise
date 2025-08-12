@extends('apps.layouts.main')

@section('content')
<div class="max-w-lg mx-auto py-10">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Buka Shift</h1>
        
    </div>

    <div class="bg-white shadow-md rounded-xl p-8 border border-gray-100">
        <form action="{{ route('apps.shifts.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Kas Awal -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kas Awal</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">Rp</span>
                    <input type="number" 
                           name="opening_cash" 
                           step="0.01" min="0"
                           placeholder="0"
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                @error('opening_cash')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea name="notes" 
                          rows="3"
                          placeholder="Tambahkan catatan awal shift..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"></textarea>
                @error('notes')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-2">
                <a href="{{ route('apps.shifts.index') }}" 
                   class="flex-1 px-4 py-3 text-center border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                    Kembali
                </a>
                <button type="submit" 
                        class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Buka Shift
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
