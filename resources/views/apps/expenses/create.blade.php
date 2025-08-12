@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Pengeluaran</h1>
        <a href="{{ route('apps.expenses.index') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">← Kembali</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('apps.expenses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-700">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded">{{ old('description') }}</textarea>
                @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Jumlah</label>
                    <input type="number" step="0.01" min="0" name="amount" value="{{ old('amount') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                    @error('amount')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Tanggal</label>
                    <input type="date" name="expense_date" value="{{ old('expense_date', now()->toDateString()) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                    @error('expense_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Kategori</label>
                <select name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                    <option value="operational">Operasional</option>
                    <option value="supplies">Perlengkapan</option>
                    <option value="maintenance">Perawatan</option>
                    <option value="other">Lainnya</option>
                </select>
                @error('category')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm text-gray-700">Bukti (opsional)</label>
                <input type="file" name="receipt_image" accept="image/*" class="mt-1 block w-full">
                @error('receipt_image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection


