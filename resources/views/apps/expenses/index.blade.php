@extends('apps.layouts.main')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengeluaran</h1>
        <a href="{{ route('apps.expenses.create') }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg">Tambah</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-3">
        <input type="date" name="start_date" value="{{ $startDate }}" class="p-2 border border-gray-300 rounded-lg">
        <input type="date" name="end_date" value="{{ $endDate }}" class="p-2 border border-gray-300 rounded-lg">
        <select name="category" class="p-2 border border-gray-300 rounded-lg">
            <option value="">Semua Kategori</option>
            <option value="operational" {{ $category==='operational' ? 'selected' : '' }}>Operasional</option>
            <option value="supplies" {{ $category==='supplies' ? 'selected' : '' }}>Perlengkapan</option>
            <option value="maintenance" {{ $category==='maintenance' ? 'selected' : '' }}>Perawatan</option>
            <option value="other" {{ $category==='other' ? 'selected' : '' }}>Lainnya</option>
        </select>
        <div>
            <button class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">Filter</button>
        </div>
    </form>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($expenses as $e)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $e->expense_date->format('d M Y') }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $e->title }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $e->category_label }}</td>
                        <td class="px-6 py-3 text-sm text-gray-900 font-semibold text-right">Rp {{ number_format($e->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-sm text-right">
                            <a href="{{ route('apps.expenses.show', $e) }}" class="text-gray-600 hover:text-gray-900 mr-3">Detail</a>
                            <a href="{{ route('apps.expenses.edit', $e) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                            <form action="{{ route('apps.expenses.destroy', $e) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus data?')" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada pengeluaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <div>{{ $expenses->links() }}</div>
        <div class="text-right">
            <span class="text-gray-600 mr-2">Total</span>
            <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
    </div>
</div>
@endsection


