<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Buat Akun Baru</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Nama</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Username</label>
                <input type="text" name="username" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" name="email" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">No. HP</label>
                <input type="text" name="phone" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Alamat</label>
                <input type="text" name="address" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition">Daftar</button>

            <p class="text-center mt-4 text-sm">Sudah punya akun? <a href="/login" class="text-indigo-600 hover:underline">Login</a></p>
        </form>
    </div>
</body>
</html>
