<style>
        .step-number {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }
        .dotted-line {
            background-image: radial-gradient(circle, #dc2626 1px, transparent 1px);
            background-size: 8px 8px;
        }
    </style>


<div class="max-w-6xl mx-auto px-4 py-16">
        <!-- Step 1 -->
        <div class="flex flex-col lg:flex-row items-center mb-[200px] gap-12">
            <div class="lg:w-1/2 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="step-number text-white text-6xl font-bold w-20 h-20 rounded-lg flex items-center justify-center shadow-lg">
                        1
                    </div>
                    <div class="dotted-line w-32 h-2 opacity-30"></div>
                </div>
                
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Akses & Buka <span class="text-red-600">FLAVORISE</span>
                    </h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Buka browser di laptop Anda dan install aplikasi web FLAVORISE melalui platform github lalu login.
                    </p>
                    
                    <div class="flex gap-4">
                        <button class="flex items-center gap-2 bg-white border-2 border-red-600 text-red-600 px-6 py-3 rounded-lg hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"/>
                            </svg>
                            Web App
                        </button>
                        
                    </div>
                </div>
            </div>
            
            <div class="lg:w-1/2 flex justify-center">
                <div class="relative">
                    <!-- Laptop Design -->
                    <div class="w-[400px] bg-gray-800 rounded-lg p-1 shadow-2xl">
                        <!-- Screen -->
                        <div class="w-full h-64 bg-white rounded-md overflow-hidden border-2 border-gray-700">
                            <img src="{{ asset('assets/img/login.png') }}" class="w-full h-full object-cover" alt="">
                        </div>
                        <!-- Keyboard -->
                        <div class="mt-1 h-2 bg-gray-700 rounded-b-lg"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="flex flex-col lg:flex-row-reverse items-center mb-[200px] gap-12">
            <div class="lg:w-1/2 space-y-6">
                <div class="flex items-center gap-4 justify-end lg:justify-start">
                    <div class="step-number text-white text-6xl font-bold w-20 h-20 rounded-lg flex items-center justify-center shadow-lg">
                        2
                    </div>
                </div>
                
                <div class="text-right lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Lakukan Registrasi dengan Ikuti Petunjuk
                    </h2>
                    <p class="text-gray-600 text-lg">
                        Buka aplikasi <span class="text-red-600 font-semibold">FLAVORISE</span> di browser, dan setting semua kebutuhan restoran mulai dari menu dan profil toko serta kategori.
                    </p>
                </div>
            </div>
            
            <div class="lg:w-1/2 flex justify-center">
                <div class="relative">
                    <!-- Laptop Design with Registration Form -->
                    <div class="w-[400px] bg-gray-800 rounded-lg p-1 shadow-2xl">
                        <!-- Screen -->
                        <div class="w-full h-64 bg-white rounded-md overflow-hidden border-2 border-gray-700">
                            <img src="{{ asset('assets/img/dashboard.png') }}" class="w-full h-full object-contain" alt="">
                        </div>
                        <!-- Keyboard -->
                        <div class="mt-1 h-2 bg-gray-700 rounded-b-lg"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="flex flex-col lg:flex-row items-center gap-12 px-5">
            <div class="lg:w-1/2 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="step-number text-white text-6xl font-bold w-20 h-20 rounded-lg flex items-center justify-center shadow-lg">
                        3
                    </div>
                </div>
                
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Aplikasi <span class="text-red-600">FLAVORISE</span> Siap di Gunakan 
                    </h2>
                    <p class="text-gray-600 text-lg">
                        Setelah setting selesai maka sistem manajemen restoran FLAVORISE dapat langsung digunakan dan bisa dijalankan dimana saja .
                    </p>
                </div>
            </div>
            
            <div class="lg:w-1/2 flex justify-center">
                <div class="relative">
                    <!-- Laptop Design with Dashboard -->
                    <div class="w-[400px] bg-gray-800 rounded-lg p-1 shadow-2xl">
                        <!-- Screen -->
                        <div class="w-full h-64 bg-white rounded-md overflow-hidden border-2 border-gray-700">
                            <img src="{{ asset('assets/img/pos.png') }}" class="w-full h-full object-contain" alt="">
                        </div>
                        <!-- Keyboard -->
                        <div class="mt-1 h-2 bg-gray-700 rounded-b-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>