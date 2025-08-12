@extends('apps.layouts.main')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Produk</h1>
        <a href="{{ route('apps.menus.create') }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg">Tambah Produk</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-4 flex gap-3">
        <select name="category_id" class="border border-gray-300 rounded-lg p-2 ">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama produk..." class="border border-gray-300 rounded-lg p-2" />
        <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-200 hover:border-gray-400 transtition-all rounded-lg">Filter</button>
    </form>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($menus as $menu)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if ($menu->image)
                                    <img src="{{ asset('storage/'.$menu->image) }}" class="w-10 h-10 rounded object-cover mr-3" />
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $menu->name }}</div>
                                    <div class="text-xs text-gray-500">#{{ $menu->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $menu->category?->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $menu->stock }}</td>
                        <td class="px-6 py-4">
                            @if ($menu->is_available)
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Tersedia</span>
                            @else
                                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">Tidak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('apps.menus.show', $menu) }}" class="text-gray-600 hover:text-gray-900 mr-3">Detail</a>
                            <a href="{{ route('apps.menus.edit', $menu) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form action="{{ route('apps.menus.destroy', $menu) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus produk ini?')" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 bg-white">{{ $menus->links() }}</div>
</div>
@endsection


