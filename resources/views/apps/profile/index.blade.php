@extends('apps.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Profil Restoran</h1>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('apps.profile.update') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-700">Nama Restoran</label>
                <input type="text" name="restaurant_name" value="{{ old('restaurant_name', $settings['restaurant_name']) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Alamat</label>
                <textarea name="address" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded">{{ old('address', $settings['address']) }}</textarea>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $settings['phone']) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">Pajak Default</label>
                    <input type="number" step="0.01" min="0" name="default_tax" value="{{ old('default_tax', $settings['default_tax']) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Diskon Default</label>
                    <input type="number" step="0.01" min="0" name="default_discount" value="{{ old('default_discount', $settings['default_discount']) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection


