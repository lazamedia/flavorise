    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 40px rgba(147, 51, 234, 0.4); }
        }
        
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-slide-up { animation: slideInUp 0.8s ease-out; }
        .animate-slide-left { animation: slideInLeft 0.8s ease-out; }
        .animate-slide-right { animation: slideInRight 0.8s ease-out; }
        
        .bg-mesh {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(147, 51, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #8d001f 0%, #ec400c 50%, #7c1b2b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            background: linear-gradient(135deg, #a51414 0%, #db3300 100%);
        }
    </style>

    <!-- Flavorise Introduction Section -->
    <section class="relative min-h-screen bg-mesh overflow-hidden" x-data="{ showVideo: false }">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-32 h-32 bg-red-400/20 rounded-full animate-float"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-red-900/20 rounded-full animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-40 left-20 w-40 h-40 bg-emerald-400/20 rounded-full animate-float" style="animation-delay: -4s;"></div>
            <div class="absolute bottom-20 right-10 w-28 h-28 bg-indigo-400/20 rounded-full animate-float" style="animation-delay: -1s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center min-h-screen">
                <!-- Left Content -->
                <div class="space-y-8 animate-slide-left">
                    <!-- Brand Introduction -->
                    <div class="space-y-4">
                        {{-- <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 feature-icon rounded-xl flex items-center justify-center animate-pulse-glow">
                                <i class="fas fa-utensils text-white text-xl"></i>
                            </div>
                            <span class="text-2xl font-bold text-gradient">Flavorise</span>
                        </div> --}}
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                            Dapatkan Kemudahan
                            <span class="text-gradient block">Dalam Satu Aplikasi</span>
                        </h1>
                        
                        <div class="relative">
                            <p class="text-xl md:text-2xl text-gray-600 font-medium mb-2">
                                "Sistem kasir all-in-one"
                            </p>
                            <div class="w-20 h-1 bg-gradient-to-r from-red-500 to-red-600 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Description -->
                    {{-- <p class="text-lg text-gray-700 leading-relaxed">
                        Revolusi cara Anda mengelola bisnis F&B dengan Flavorise. Sistem kasir all-in-one yang menggabungkan 
                        kecepatan, akurasi, dan kemudahan dalam satu platform yang powerful.
                    </p> --}}

                    <!-- Key Features -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-bolt text-red-600"></i>
                            </div>
                            <span class="text-gray-700 font-medium">Transaksi Super Cepat</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-red-900"></i>
                            </div>
                            <span class="text-gray-700 font-medium">Laporan Real-time</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-emerald-600"></i>
                            </div>
                            <span class="text-gray-700 font-medium">Multi Platform</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-cloud text-orange-600"></i>
                            </div>
                            <span class="text-gray-700 font-medium">Cloud Storage</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="/documentation" class="px-8 py-4 bg-gradient-to-r from-red-500 to-red-800 hover:from-red-600 hover:to-red-800 text-white font-semibold rounded-xl transition-all duration-300 hover:shadow-2xl  flex items-center justify-center space-x-2">
                            <i class="fas fa-rocket"></i>
                            <span>Documentation</span>
                        </a>
                        <button 
                        @click="showVideo = true" 
                        class="px-8 py-4 border-2 border-gray-300 hover:border-red-500 text-gray-700 hover:text-red-600 font-semibold rounded-xl transition-all duration-300 hover:bg-red-50 flex items-center justify-center space-x-2">
                            <i class="fas fa-play-circle"></i>
                            <span>Lihat Demo</span>
                        </button>
                    </div>

                    <!-- Popup/Modal -->
                    <div 
                        x-show="showVideo" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
                        @click="showVideo = false">
                        
                        <div 
                            @click.stop
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-300 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90"
                            class="bg-none rounded-2xl  max-w-3xl mx-4 w-full max-h-[90vh] overflow-auto">
                        
                            
                            <!-- Content -->
                            <div class="space-y-4">
                                <div class=" rounded-lg aspect-video flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <iframe 
                                        class="rounded-lg border-2 border-white"
                                        width="700" height="400" src="https://www.youtube.com/embed/wJAM_zowiUQ?si=hTwL1KiQ9kGolzuA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Trust Indicators -->
                    {{-- <div class="flex items-center space-x-6 pt-6 border-t border-gray-200">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">1000+</div>
                            <div class="text-sm text-gray-600">Restoran Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">50K+</div>
                            <div class="text-sm text-gray-600">Transaksi/Hari</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">99.9%</div>
                            <div class="text-sm text-gray-600">Uptime</div>
                        </div>
                    </div> --}}
                </div>

                <!-- Right Content - App Preview -->
                <div class="relative animate-slide-right mt-16 lg:mt-0">
                    <!-- Main Device Mockup -->
                    <div class="relative mx-auto w-80 h-96 bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-2 shadow-2xl animate-float">
                        <!-- Screen -->
                        <div class="w-full h-full bg-white rounded-2xl overflow-hidden relative">
                            <!-- Status Bar -->
                            <div class="bg-gradient-to-r from-red-500 to-red-900 h-12 flex items-center justify-between px-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-utensils text-white text-xs"></i>
                                    </div>
                                    <span class="text-white font-semibold">Flavorise POS</span>
                                </div>
                                <div class="text-white text-sm">09:41</div>
                            </div>

                            <!-- App Content -->
                            <div class="p-4 space-y-4">
                                <!-- Quick Stats -->
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-red-50 p-3 rounded-xl">
                                        <div class="text-xs text-red-600 font-medium">Hari Ini</div>
                                        <div class="text-lg font-bold text-red-900">Rp 2.4M</div>
                                    </div>
                                    <div class="bg-emerald-50 p-3 rounded-xl">
                                        <div class="text-xs text-emerald-600 font-medium">Orders</div>
                                        <div class="text-lg font-bold text-emerald-900">127</div>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <div class="space-y-2">
                                    <div class="text-sm font-semibold text-gray-700">Menu Populer</div>
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-hamburger text-orange-600 text-xs"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium">Nasi Goreng</div>
                                                <div class="text-xs text-gray-500">Rp 25.000</div>
                                            </div>
                                        </div>
                                        <button class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">+</button>
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-green-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-leaf text-green-600 text-xs"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium">Gado-gado</div>
                                                <div class="text-xs text-gray-500">Rp 20.000</div>
                                            </div>
                                        </div>
                                        <button class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">+</button>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="grid grid-cols-2 gap-2 pt-2">
                                    <button class="py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-medium rounded-lg">
                                        <i class="fas fa-shopping-cart mr-1"></i>
                                        Checkout
                                    </button>
                                    <button class="py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg">
                                        <i class="fas fa-history mr-1"></i>
                                        Riwayat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Feature Cards -->
                    <div class="absolute -top-8 -left-1 w-32 h-auto bg-white rounded-xl shadow-lg p-3 card-hover">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-qrcode text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-gray-900">QR Payment</div>
                                <div class="text-xs text-gray-500">Scan & Pay</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-8 -right-1 w-36 h-auto bg-white rounded-xl shadow-lg p-3 card-hover">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-bar text-emerald-600 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-gray-900">Analytics</div>
                                <div class="text-xs text-gray-500">Real-time Data</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-1/2 -right-2 w-28 h-16 bg-white rounded-xl shadow-lg p-2 card-hover">
                        <div class="text-center">
                            <div class="w-6 h-6 bg-red-200 rounded-lg flex items-center justify-center mx-auto mb-1">
                                <i class="fas fa-sync text-red-900 text-xs"></i>
                            </div>
                            <div class="text-xs font-semibold text-gray-900">Auto Sync</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1200 120" class="w-full h-20 fill-white">
                <path d="M0,60 C300,120 900,0 1200,60 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </section>