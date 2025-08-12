@extends('apps.layouts.main')

@section('content')
{{-- small x-cloak style so element is hidden before Alpine initialises --}}
<style>[x-cloak]{display:none!important}</style>

<div class="max-w-3xl mx-auto" 
     x-data="{ openImage: false, imageUrl: '', zoom: 1 }" x-cloak>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Pengeluaran</h1>
        <a href="{{ route('apps.expenses.index') }}" 
           class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm">
           ← Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="font-medium text-gray-600">Tanggal</p>
                    <p class="text-gray-800">{{ $expense->expense_date->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-600">Kategori</p>
                    <p class="text-gray-800">{{ $expense->category_label }}</p>
                </div>
            </div>

            <div>
                <p class="font-medium text-gray-600">Judul</p>
                <p class="text-lg font-semibold text-gray-900">{{ $expense->title }}</p>
            </div>

            <div>
                <p class="font-medium text-gray-600">Deskripsi</p>
                <p class="text-gray-800">{{ $expense->description ?: '-' }}</p>
            </div>

            <div>
                <p class="font-medium text-gray-600">Jumlah</p>
                <p class="text-lg font-bold text-red-600">Rp {{ number_format($expense->amount, 0, ',', '.') }}</p>
            </div>

            {{-- Bukti Pengeluaran (klik untuk buka popup + zoom) --}}
            @if($expense->receipt_image)
                <div>
                    <p class="font-medium text-gray-600 mb-2">Bukti</p>
                    <img
                        src="{{ asset('storage/'.$expense->receipt_image) }}"
                        data-src="{{ asset('storage/'.$expense->receipt_image) }}"
                        alt="Bukti Pengeluaran"
                        @click="imageUrl = $event.currentTarget.dataset.src; openImage = true; zoom = 1"
                        class="w-60 h-60 object-cover rounded-lg shadow-sm border cursor-pointer hover:opacity-90 transition"
                    />
                    <p class="text-xs text-gray-500 mt-2">Klik gambar untuk perbesar. Scroll untuk zoom, double-click untuk reset.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- IMAGE LIGHTBOX -->
    <div
        x-show="openImage"
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
        @click.self="openImage = false; zoom = 1"
        @keydown.escape.window="openImage = false; zoom = 1"
        style="backdrop-filter: blur(4px);"
        x-cloak
    >
        <div class="relative max-w-[95vw] max-h-[90vh] p-4">
            <!-- Close -->
            <button @click="openImage = false; zoom = 1"
                    class="absolute top-3 right-3 hidden bg-white/90 text-gray-700 rounded-full p-2 shadow hover:bg-white">
                ✕
            </button>

            <!-- Image container: wheel zoom + dblclick reset -->
            <div class="flex items-center justify-center z-10">
                <img
                    :src="imageUrl"
                    alt="Preview"
                    @wheel.prevent="zoom = Math.min(4, Math.max(1, (zoom - ($event.deltaY * 0.001))))"
                    @dblclick="zoom = 1"
                    :style="'transform: scale(' + zoom + ');'"
                    class="max-w-full max-h-[80vh] object-contain transition-transform duration-150 cursor-zoom-in"
                />
            </div>

            <!-- Controls -->
            <div class="mt-3 text-center text-sm text-white/90 z-50">
                <button @click="zoom = Math.min(4, zoom + 0.25)" class="px-3 py-1 bg-white/10 rounded mr-2">+</button>
                <button @click="zoom = Math.max(1, zoom - 0.25)" class="px-3 py-1 bg-white/10 rounded mr-2">−</button>
                <button @click="zoom = 1" class="px-3 py-1 bg-white/10 rounded">Reset</button>
            </div>
        </div>
    </div>
</div>

<!-- fallback: load Alpine if not present (only if you didn't include Alpine in your layout) -->
<script>
    (function(){
        if (!window.Alpine) {
            const s = document.createElement('script');
            s.src = 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js';
            s.defer = true;
            document.head.appendChild(s);
        }
    })();
</script>
@endsection
