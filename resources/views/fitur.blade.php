@extends('layouts.main')

@section('content')

   <style>
        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
        .feature-transition {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .button-transition {
            transition: all 0.3s ease;
        }
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header Section -->
    <section class="gradient-bg text-white py-16 px-4 mt-[80px] h-[70vh] content-center items-center">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl font-light mb-6 leading-tight">
                        Aplikasi FLAVORISE dikembangkan untuk mengoptimalkan efisiensi kinerja restoran Anda dan menyajikan service level terbaik.
                    </h1>
                    <p class="text-lg opacity-90 font-light">
                        Mulai dari memudahkan pencatatan pesanan, monitoring, hingga menyediakan berbagai tipe pembayaran.
                    </p>
                </div>
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-[400px] bg-gray-800 rounded-lg p-1 shadow-2xl">
                        <!-- Screen -->
                        <div class="w-full h-64 bg-white rounded-md overflow-hidden border-2 border-gray-700">
                            <img src="{{ asset('assets/img/dashboard.png') }}" class="w-full h-full object-cover" alt="">
                        </div>
                        <!-- Keyboard -->
                        <div class="mt-1 h-2 bg-gray-700 rounded-b-lg"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Features Section -->
<section class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="grid gap-6 md:grid-cols-2">
            <!-- Feature 1 -->
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Lebih dari Sekadar POS
                </h3>
                <p class="text-sm text-gray-600">
                    Meminimalisir kompleksitas operasional restoran dengan fitur terintegrasi.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Integrasi Operasional
                </h3>
                <p class="text-sm text-gray-600">
                    Menghubungkan semua unit: Waiter, Chef, Barista, Kasir, Manager, hingga Owner.
                </p>
            </div>

            <!-- Feature 3 with highlight -->
            <div class="p-6 bg-white rounded-lg shadow-sm ">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Optimasi Efisiensi Kinerja
                </h3>
                <p class="text-sm text-gray-600">
                    Owner fokus pada hal esensial sambil tetap memberikan pelayanan terbaik.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Hemat Biaya Investasi
                </h3>
                <p class="text-sm text-gray-600">
                    Tidak perlu mesin POS terpisah. Cukup smartphone untuk operasional dalam genggaman.
                </p>
            </div>

        </div>
    </div>
</section>

    <!-- Features Navigation -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-12">
                Fitur Unggulan Kami
            </h2>
            
            <!-- Feature buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button id="btn-0" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(0)">
                    Sistem Autentikasi
                </button>
                <button id="btn-1" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(1)">
                    POS Real-time
                </button>
                <button id="btn-2" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(2)">
                    Manajemen Shift
                </button>
                <button id="btn-3" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(3)">
                    Laporan Penjualan
                </button>
                <button id="btn-4" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(4)">
                    Manajemen Pengeluaran
                </button>
                <button id="btn-5" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(5)">
                    Manajemen Produk
                </button>
                <button id="btn-6" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(6)">
                    Monitoring
                </button>
                <button id="btn-7" class="feature-btn px-6 py-3 rounded-full button-transition font-medium" onclick="showFeature(7)">
                    Dasbor
                </button>
            </div>

            <!-- Featured Content -->
            <div id="feature-content" class="grid md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <div class="relative">
                        <div class="w-full max-w-[400px] mx-auto bg-gray-800 rounded-lg p-1 shadow-2xl">
                            <!-- Screen -->
                            <div id="feature-image" class="w-full h-64 bg-white rounded-md overflow-hidden border-2 border-gray-700 feature-transition">
                                <img id="feature-img" src="{{ asset('assets/img/dashboard.png') }}" alt="Feature Preview">
                            </div>
                            <!-- Keyboard -->
                            <div class="mt-1 h-2 bg-gray-700 rounded-b-lg"></div>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2 text-left">
                    <h3 id="feature-title" class="text-2xl font-bold text-gray-800 mb-6 feature-transition">
                        Sistem Autentikasi
                    </h3>
                    <p id="feature-description" class="text-gray-600 text-lg leading-relaxed feature-transition">
                        Fitur ini memungkinkan pengguna untuk melakukan autentikasi dengan aman menggunakan berbagai metode, termasuk rate limiting sehingga mencegah serangan yang tidak diinginkan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation arrows -->
    <div class="flex justify-center space-x-4 py-8">
        <button id="prev-btn" class="w-12 h-12 rounded-full border-2 border-red-600 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300 transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="next-btn" class="w-12 h-12 rounded-full border-2 border-red-600 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300 transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- Progress indicators -->
    <div class="flex justify-center space-x-2 pb-8">
        <div id="indicators" class="flex space-x-2"></div>
    </div>

<script>
        const features = [
            {
                title: 'Sistem Autentikasi',
                description: 'Fitur ini memungkinkan pengguna untuk melakukan autentikasi dengan aman menggunakan berbagai metode, termasuk rate limiting sehingga mencegah serangan yang tidak diinginkan.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            },
            {
                title: 'POS Real-time',
                description: 'Sistem POS yang memberikan informasi penjualan secara real-time, memungkinkan pemilik restoran untuk memantau performa penjualan dan membuat keputusan yang lebih cepat.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            },
            {
                title: 'Manajemen Shift',
                description: 'Fitur untuk mengelola laporan penjualan berdasarkan sift yang aktif sehingga memudahkan dalam pembukuan laporan setiap harinya dan meningkatkan akurasi data.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            },
            {
                title: 'Laporan Penjualan',
                description: 'Fitur untuk menghasilkan laporan penjualan yang komprehensif dan mudah dipahami. Pemilik restoran dapat menganalisis performa penjualan, tren, dan insights penting lainnya.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            },
            {
                title: 'Manajemen Pengeluaran',
                description: 'Fitur untuk mengelola dan memantau pengeluaran restoran dengan lebih efektif. Pemilik restoran dapat melihat laporan pengeluaran secara rinci dan menganalisis biaya untuk pengambilan keputusan yang lebih baik.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            },
            {
                title: 'Manajemen Produk',
                description: 'Pengelolaan produk dengan sistem yang efisien dan mudah diakses. Kelola inventory, harga, kategori, dan variasi produk dengan mudah melalui dashboard yang komprehensif.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            },
            {
                title: 'Monitoring',
                description: 'Fitur untuk memonitor berbagai aktivitas dalam restoran secara real-time. Pantau performa, penjualan, dan operasional restoran dengan dashboard yang informatif dan mudah dipahami.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            },
            {
                title: 'Dasbor',
                description: 'Dasbor yang menampilkan data dan laporan penting restoran secara terperinci. Analisis penjualan, performa karyawan, dan insights bisnis yang membantu pengambilan keputusan strategis.',
                image: `{{ asset('assets/img/dashboard.png') }}`
            }
        ];

        let currentFeature = 2;  // Default feature is Self Order & Digital Menu
        let isTransitioning = false;

        function updateActiveButton(index) {
            const buttons = document.querySelectorAll('.feature-btn');
            buttons.forEach((btn, idx) => {
                btn.classList.remove('bg-red-600', 'text-white', 'shadow-lg', 'transform', 'scale-105');
                btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                
                if (idx === index) {
                    btn.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    btn.classList.add('bg-red-600', 'text-white', 'shadow-lg', 'transform', 'scale-105');
                }
            });
        }

        function updateIndicators(index) {
            const indicatorsContainer = document.getElementById('indicators');
            indicatorsContainer.innerHTML = '';
            
            for (let i = 0; i < features.length; i++) {
                const indicator = document.createElement('div');
                indicator.className = `w-2 h-2 rounded-full transition-all duration-300 ${
                    i === index ? 'bg-red-600 w-8' : 'bg-gray-300'
                }`;
                indicatorsContainer.appendChild(indicator);
            }
        }

        function showFeature(index, skipTransition = false) {
            if (isTransitioning && !skipTransition) return;
            
            isTransitioning = true;
            currentFeature = index;

            // Update buttons
            updateActiveButton(index);
            
            // Update indicators
            updateIndicators(index);

            // Add fade effect
            const content = document.getElementById('feature-content');
            const title = document.getElementById('feature-title');
            const description = document.getElementById('feature-description');
            const img = document.getElementById('feature-img');

            if (!skipTransition) {
                content.style.opacity = '0.3';
                
                setTimeout(() => {
                    title.textContent = features[index].title;
                    description.textContent = features[index].description;
                    img.src = features[index].image;
                    img.alt = features[index].title;
                    
                    content.style.opacity = '1';
                    isTransitioning = false;
                }, 200);
            } else {
                title.textContent = features[index].title;
                description.textContent = features[index].description;
                img.src = features[index].image;
                img.alt = features[index].title;
                isTransitioning = false;
            }
        }

        // Navigation button event listeners
        document.getElementById('prev-btn').addEventListener('click', () => {
            if (isTransitioning) return;
            currentFeature = (currentFeature - 1 + features.length) % features.length;
            showFeature(currentFeature);
        });

        document.getElementById('next-btn').addEventListener('click', () => {
            if (isTransitioning) return;
            currentFeature = (currentFeature + 1) % features.length;
            showFeature(currentFeature);
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                document.getElementById('prev-btn').click();
            } else if (e.key === 'ArrowRight') {
                document.getElementById('next-btn').click();
            }
        });

        // Auto-play functionality (optional)
        let autoPlayInterval;
        
        function startAutoPlay() {
            autoPlayInterval = setInterval(() => {
                if (!isTransitioning) {
                    currentFeature = (currentFeature + 1) % features.length;
                    showFeature(currentFeature);
                }
            }, 5000);
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }

        // Stop auto-play on user interaction
        document.querySelectorAll('.feature-btn, #prev-btn, #next-btn').forEach(btn => {
            btn.addEventListener('click', stopAutoPlay);
        });

        // Start auto-play
        startAutoPlay();
    </script>



@endsection