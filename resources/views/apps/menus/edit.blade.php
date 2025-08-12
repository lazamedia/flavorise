@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800"> Edit Produk</h1>
        <a href="{{ route('apps.menus.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
            ← Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-xl p-6">
        <form action="{{ route('apps.menus.update', $menu) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $menu->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $menu->name) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required>
                @error('name')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga & Stok -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $menu->price) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required>
                    @error('price')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" min="0" name="stock" value="{{ old('stock', $menu->stock) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    @error('stock')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm">
                @if ($menu->image)
                    <img src="{{ asset('storage/'.$menu->image) }}" class="w-24 h-24 object-cover rounded-lg mt-3 shadow">
                @endif
                @error('image')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_available" value="1" class="h-4 w-4 text-red-600 focus:ring-red-500 p-2 border border-gray-300 rounded" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                <label for="is_available" class="ml-2 text-sm text-gray-700">Tersedia</label>
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit" class="px-6 py-2 bg-slate-900 hover:bg-slate-950 text-white font-medium rounded-lg shadow transition">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
