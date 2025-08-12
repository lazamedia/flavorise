@extends('apps.layouts.main')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pegawai</h1>
        <a href="{{ route('apps.users.create') }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg">Tambah</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-4 grid grid-cols-1 md:grid-cols-5 gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/username/email" class="p-2 border border-gray-300 rounded">
        <select name="role" class="p-2 border border-gray-300 rounded">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role')==='admin'? 'selected':'' }}>Admin</option>
            <option value="kasir" {{ request('role')==='kasir'? 'selected':'' }}>Kasir</option>
        </select>
        <select name="is_active" class="p-2 border border-gray-300 rounded">
            <option value="">Semua Status</option>
            <option value="1" {{ request('is_active')==='1'? 'selected':'' }}>Aktif</option>
            <option value="0" {{ request('is_active')==='0'? 'selected':'' }}>Nonaktif</option>
        </select>
        <div class="md:col-span-2 flex items-end">
            <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Filter</button>
        </div>
    </form>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $user->username }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700 capitalize">{{ $user->role }}</td>
                        <td class="px-6 py-3 text-sm">@if($user->is_active)<span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Aktif</span>@else<span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">Nonaktif</span>@endif</td>
                        <td class="px-6 py-3 text-sm text-right">
                            <a href="{{ route('apps.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                            <form action="{{ route('apps.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pegawai?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada pegawai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection


