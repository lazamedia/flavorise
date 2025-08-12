@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Kategori</h1>
        <a href="{{ route('apps.categories.index') }}" 
           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
            ← Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl p-6">
        <form action="{{ route('apps.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama Kategori --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-100"
                       required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-100">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Gambar</label>
                <input type="file" name="image" accept="image/*"
                       class="mt-1 block w-full p-2 border text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                
                @if ($category->image)
                    <div class="mt-3">
                        <img src="{{ asset('storage/'.$category->image) }}" 
                             class="w-28 h-28 object-cover rounded-lg shadow-sm border border-gray-200" />
                    </div>
                @endif

                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="is_active" value="1" id="is_active"
                       class="rounded border-gray-300 text-red-600 focus:ring-red-500"
                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="text-sm text-gray-700">Aktif</label>
            </div>

            {{-- Tombol Update --}}
            <div class="pt-2">
                <button type="submit" 
                        class="px-5 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg shadow-sm transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
