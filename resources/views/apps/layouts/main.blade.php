<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: false,
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { font-family: 'Inter'; }
        .nav-active { color: #111827; }
        .btn-primary { @apply bg-red-600 hover:bg-red-700 text-white; }
    </style>
    
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('apps.layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64">
            <!-- Header -->
            @include('apps.layouts.header')

            <!-- Dashboard Content -->
            <main class="p-6 bg-gray-100 mt-5">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative max-w-sm mx-auto mt-40 bg-white rounded-xl shadow-xl p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Logout</h3>
            <p class="text-sm text-gray-600 mb-4">Yakin ingin logout? Pastikan shift sudah ditutup. Jika masih aktif, Anda akan diarahkan untuk menutup shift.</p>
            <div class="flex justify-end gap-2">
                <button id="cancelLogout" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded">Batal</button>
                <button id="confirmLogout" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Logout</button>
            </div>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutForm = document.getElementById('logoutForm');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogout = document.getElementById('cancelLogout');
        const confirmLogout = document.getElementById('confirmLogout');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                if (sidebar) sidebar.classList.remove('-translate-x-full');
                if (overlay) overlay.classList.remove('hidden');
            });
        }

        if (closeSidebar) {
            closeSidebar.addEventListener('click', () => {
                if (sidebar) sidebar.classList.add('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                if (sidebar) sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }

        // Auto-hide sidebar overlay on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                overlay.classList.add('hidden');
            }
        });

        if (logoutBtn && logoutForm && logoutModal && cancelLogout && confirmLogout) {
            logoutBtn.addEventListener('click', (e) => {
                e.preventDefault();
                logoutModal.classList.remove('hidden');
            });
            cancelLogout.addEventListener('click', () => logoutModal.classList.add('hidden'));
            confirmLogout.addEventListener('click', () => {
                logoutModal.classList.add('hidden');
                logoutForm.submit();
            });
        }
    </script>
</body>
</html>