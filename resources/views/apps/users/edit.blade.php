@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Pegawai</h1>
        <a href="{{ route('apps.users.index') }}" class="px-3 py-2  hover:bg-gray-100 text-gray-800 rounded-lg">← Kembali</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('apps.users.update', $user) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Password (kosongkan jika tidak ganti)</label>
                    <input type="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Role</label>
                    <select name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                        <option value="kasir" {{ old('role', $user->role)==='kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="admin" {{ old('role', $user->role)==='admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Status</label>
                    <select name="is_active" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                        <option value="1" {{ old('is_active', $user->is_active) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !old('is_active', $user->is_active) ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Alamat</label>
                <textarea name="address" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded">{{ old('address', $user->address) }}</textarea>
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection


