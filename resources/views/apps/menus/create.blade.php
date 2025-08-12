@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Produk</h1>
        <a href="{{ route('apps.menus.index') }}" 
           class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg shadow-sm transition">
           ← Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <form action="{{ route('apps.menus.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                <select name="category_id" class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500" requislate>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-xs text-slate-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500" requislate>
                @error('name')
                    <p class="text-xs text-slate-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga & Stok -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga</label>
                    <input type="number" step="0.01" min="0" name="price" value="{{ old('price') }}"
                           class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500" requislate>
                    @error('price')
                        <p class="text-xs text-slate-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                    <input type="number" min="0" name="stock" value="{{ old('stock', 0) }}"
                           class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500">
                    @error('stock')
                        <p class="text-xs text-slate-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" rows="4" 
                          class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-slate-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>
                <input type="file" name="image" accept="image/*" 
                       class="block w-full text-sm text-gray-600 p-2 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500">
                @error('image')
                    <p class="text-xs text-slate-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ketersediaan -->
            <div class="flex items-center">
                <input type="checkbox" name="is_available" value="1" id="is_available"
                       class="w-4 h-4 text-slate-600 p-2 border border-gray-300 rounded focus:ring-slate-500" checked>
                <label for="is_available" class="ml-2 text-sm text-gray-700">Tersedia</label>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('apps.menus.index') }}" 
                   class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg shadow-sm transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg shadow-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
