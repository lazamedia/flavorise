@extends('apps.layouts.main')

@section('content')


<div class="max-w-7xl mx-auto">
    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Shift</h1>
        @if(!$activeShift)
            <a href="{{ route('apps.shifts.create') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg">Buka Shift</a>
        @else
            <a href="{{ route('apps.shifts.close-form', $activeShift) }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-lg">Tutup Shift</a>
        @endif
    </div>

    <form method="GET" class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-3">
        <select name="status" class="p-2 border border-gray-300 rounded-lg">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status')==='active' ? 'selected' : '' }}>Aktif</option>
            <option value="closed" {{ request('status')==='closed' ? 'selected' : '' }}>Tutup</option>
        </select>
        <input type="date" name="date" value="{{ request('date') }}" class="p-2 border border-gray-300 rounded-lg" />
        <div>
            <button class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">Filter</button>
        </div>
    </form>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kasir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mulai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Selesai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Omzet</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($shifts as $shift)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($shift->shift_date)->translatedFormat('d F Y') }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $shift->user?->name ?? '-' }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $shift->end_time ? \Carbon\Carbon::parse($shift->end_time)->format('H:i') : '-' }}</td>
                        <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Rp {{ number_format($shift->total_sales, 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700 capitalize">{{ $shift->status }}</td>
                        <td class="px-6 py-3 text-sm text-right">
                            <a href="{{ route('apps.shifts.show', $shift) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">Belum ada data shift.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $shifts->links() }}</div>
</div>
@endsection


