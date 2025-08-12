@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Produk</h1>
        <a href="{{ route('apps.menus.index') }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm">Kembali</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        @if ($menu->image)
            <img src="{{ asset('storage/'.$menu->image) }}" class="w-full h-56 object-cover">
        @endif

        <div class="p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $menu->name }}</h2>
                <p class="text-sm text-gray-500">ID: #{{ $menu->id }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="font-medium text-gray-600">Kategori</p>
                    <p class="text-gray-800">{{ $menu->category?->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-600">Harga</p>
                    <p class="text-gray-800">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-600">Stok</p>
                    <p class="text-gray-800">{{ $menu->stock }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-600">Status</p>
                    @if ($menu->is_available)
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded">Tersedia</span>
                    @else
                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded">Tidak Tersedia</span>
                    @endif
                </div>
            </div>

            <div>
                <p class="font-medium text-gray-600">Deskripsi</p>
                <p class="text-gray-800">{{ $menu->description ?: '-' }}</p>
            </div>

            <div class="pt-4 flex gap-3">
                <a href="{{ route('apps.menus.edit', $menu) }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg text-sm">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
