@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Pegawai</h1>
        <a href="{{ route('apps.users.index') }}" class="px-3 py-2  hover:bg-gray-100 text-gray-800 rounded-lg">← Kembali</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('apps.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                    @error('username')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Password</label>
                    <input type="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                    @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Role</label>
                    <select name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                        <option value="kasir">Kasir</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Status</label>
                    <select name="is_active" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                        <option value="1" selected>Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Alamat</label>
                <textarea name="address" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded">{{ old('address') }}</textarea>
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection


