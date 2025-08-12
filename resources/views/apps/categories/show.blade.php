@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Kategori</h1>
        <a href="{{ route('apps.categories.index') }}" 
           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
            ← Kembali
        </a>
    </div>

    {{-- Card Detail --}}
    <div class="bg-white shadow-md rounded-xl p-6 space-y-5">
        
        {{-- Gambar & Nama --}}
        <div class="flex items-center gap-5">
            @if ($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" 
                     alt="{{ $category->name }}" 
                     class="w-28 h-28 object-cover rounded-lg border border-gray-200 shadow-sm" />
            @else
                <div class="w-28 h-28 flex items-center justify-center bg-gray-100 text-gray-400 rounded-lg border border-gray-200">
                    
                </div>
            @endif

            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
                <p class="text-sm text-gray-500">ID: #{{ $category->id }}</p>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-1">Deskripsi</h3>
            <p class="text-gray-700 leading-relaxed">{{ $category->description ?: '-' }}</p>
        </div>

        {{-- Status --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-1">Status</h3>
            @if ($category->is_active)
                <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Aktif</span>
            @else
                <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Nonaktif</span>
            @endif
        </div>

        {{-- Tanggal Dibuat & Diperbarui --}}
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
            <div>
                <span class="font-medium">Dibuat:</span> {{ $category->created_at->format('d M Y H:i') }}
            </div>
            <div>
                <span class="font-medium">Diperbarui:</span> {{ $category->updated_at->format('d M Y H:i') }}
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="pt-4 flex gap-3">
            <a href="{{ route('apps.categories.edit', $category) }}" 
               class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg shadow-sm transition">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
