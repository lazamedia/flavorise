    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'red-primary': '#dc2626',
                        'red-secondary': '#ef4444',
                        'pink-gradient': '#ec4899'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui']
                    }
                }
            }
        }
    </script>
    <style>
        .laptop-shadow {
            box-shadow: 
                0 20px 40px -8px rgba(0, 0, 0, 0.3),
                0 5px 15px -5px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
        .screen-glow {
            box-shadow: 
                inset 0 0 80px rgba(59, 130, 246, 0.05),
                0 0 40px rgba(59, 130, 246, 0.1);
        }
        .keyboard-key {
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            box-shadow: 
                0 2px 4px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        .trackpad {
            background: linear-gradient(145deg, #f1f3f4, #e8eaed);
        }
        .app-window {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>

    <section class="min-h-screen bg-gradient-to-br from-red-50 via-white to-pink-50 py-16">
        <!-- Judul -->
        <div class="text-center mb-16">
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                <span class="text-red-600">Flavorise</span>, Aplikasi Bisnis Restoran Terintegrasi yang Mendukung Produktivitas
            </h1>
            <p class="text-xl text-gray-700 mt-4">Proses Kerja Restoran Menjadi Lebih Efisien</p>
        </div>

        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- Box Keterangan di Kiri -->
                <div class="space-y-8">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Fitur Utama</h3>
                        <p class="text-gray-600 mb-4">
                            Dengan <span class="font-semibold text-red-600">Flavorise</span>, Anda dapat meningkatkan efisiensi dan produktivitas di restoran Anda.
                        </p>
                        <div class="border-t border-gray-300 mt-6 pt-6">
                            <h4 class="text-lg font-medium text-gray-700">Pencatatan Order Digital</h4>
                            <p class="text-gray-600 text-sm">Pencatatan order secara digital dalam waktu nyata untuk mempermudah proses pemesanan.</p>
                        </div>
                        <div class="border-t border-gray-300 mt-6 pt-6">
                            <h4 class="text-lg font-medium text-gray-700">Metode Pembayaran Lengkap</h4>
                            <p class="text-gray-600 text-sm">Tersedia berbagai metode pembayaran, seperti tunai, e-wallet, QRIS, dan lainnya.</p>
                        </div>
                    </div>
                </div>

                <!-- Mockup Laptop Realistis di Kanan -->
                <div class="flex justify-center items-center">
                    <div class="relative transform -rotate-2 hover:rotate-0 transition-transform duration-500">
                        <!-- Laptop Body -->
                        <div class="relative">
                            <!-- Laptop Base/Bottom -->
                            {{-- <div class="w-[600px] h-[20px] bg-gradient-to-r from-gray-300 via-gray-200 to-gray-300 rounded-b-2xl laptop-shadow"></div> --}}
                            
                            <!-- Laptop Screen/Top -->
                            <div class="w-[600px] h-[380px] bg-gradient-to-b from-gray-800 to-gray-900 rounded-t-2xl relative mb-1">
                                <!-- Screen Bezel -->
                                <div class="absolute inset-3 bg-black rounded-lg">
                                    <!-- Actual Screen -->
                                     <div class="w-full h-full bg-gradient-to-br from-blue-50 to-white rounded-lg screen-glow relative overflow-hidden">
                                        <!-- Gambar pada Layar Laptop -->
                                        <img src="{{ asset('assets/img/dashboard.png') }}" alt="Flavorise App Interface" class="w-full h-full object-contain rounded-lg">
                                    </div>
                                </div>
                                
                                <!-- Camera -->
                                <div class="absolute top-2 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            
                            <!-- Keyboard Area -->
                            <div class="w-[600px] h-[150px] bg-gradient-to-b from-gray-200 to-gray-300 rounded-b-2xl p-4 laptop-shadow">
                                <!-- Keyboard -->
                                <div class="grid grid-cols-12 gap-1 mb-3">
                                    <!-- Row 1 -->
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">Q</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">W</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">E</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">R</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">T</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">Y</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">U</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">I</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">O</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">P</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700 col-span-2">Delete</div>
                                </div>
                                
                                <!-- Row 2 -->
                                <div class="grid grid-cols-12 gap-1 mb-3">
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">A</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">S</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">D</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">F</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">G</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">H</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">J</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">K</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">L</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700 col-span-3">Enter</div>
                                </div>
                                
                                <!-- Row 3 -->
                                <div class="grid grid-cols-12 gap-1 mb-4">
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700 col-span-2">Shift</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">Z</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">X</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">C</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">V</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">B</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">N</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700">M</div>
                                    <div class="keyboard-key h-6 rounded text-xs flex items-center justify-center text-gray-700 col-span-3">Shift</div>
                                </div>
                                
                                <!-- Trackpad -->
                                {{-- <div class="mx-auto w-32 h-16 trackpad rounded-lg border border-gray-300"></div> --}}
                            </div>
                        </div>
                        
                        <!-- Laptop Shadow -->
                        <div class="absolute -bottom-8 left-4 right-4 h-4 bg-black opacity-20 blur-xl rounded-full"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>