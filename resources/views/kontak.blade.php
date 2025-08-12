@extends('layouts.main')

@section('content')

    <style>
        .gradient-bg {
            background-color: #8b0101e5;
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Floating label styles - diperbaiki */
        .floating-label {
            position: relative;
        }
        
        .floating-label input,
        .floating-label textarea {
            padding-top: 1.25rem;
            padding-bottom: 0.75rem;
        }
        
        .floating-label label {
            position: absolute;
            left: 1rem;
            top: 0.75rem;
            color: #6b7280;
            font-size: 1rem;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 0.25rem;
            z-index: 1;
        }
        
        .floating-label input:focus + label,
        .floating-label textarea:focus + label,
        .floating-label input.has-value + label,
        .floating-label textarea.has-value + label {
            top: -0.5rem;
            font-size: 0.875rem;
            color: #dc2626;
            background: white;
        }
        
        .floating-label input:focus,
        .floating-label textarea:focus {
            border-color: #dc2626;
        }
    </style>
    

    <header class="gradient-bg text-white py-16 relative overflow-hidden mt-16">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4 animate-fade-in">Hubungi Kami</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">Kami siap membantu Anda. Jangan ragu untuk menghubungi tim kami kapan saja.</p>
            </div>
        </div>
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white opacity-10 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white opacity-5 rounded-full animate-pulse-slow"></div>
    </header>

    <main class="container mx-auto px-6 py-12">
        <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Form Kontak -->
            <div class="bg-white rounded-2xl shadow-xl p-8 hover-lift">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Kirim Pesan</h2>
                    <p class="text-gray-600">Isi form di bawah ini dan kami akan segera merespon pesan Anda.</p>
                </div>

                <form id="contactForm" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="floating-label">
                            <input type="text" id="nama" name="nama" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition-colors">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        
                        <div class="floating-label">
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition-colors">
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="floating-label">
                        <input type="tel" id="telepon" name="telepon"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition-colors">
                        <label for="telepon">Nomor Telepon</label>
                    </div>

                    <div class="relative">
                        <select id="subjek" name="subjek" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-red-500 focus:outline-none transition-colors">
                            <option value="">Pilih Subjek</option>
                            <option value="umum">Pertanyaan Umum</option>
                            <option value="dukungan">Dukungan Teknis</option>
                            <option value="kerjasama">Kerjasama Bisnis</option>
                            <option value="keluhan">Keluhan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="floating-label">
                        <textarea id="pesan" name="pesan" rows="5" required
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition-colors resize-none"></textarea>
                        <label for="pesan">Pesan Anda</label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-red-600 to-red-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-red-700 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Informasi Kontak -->
            <div class="space-y-8">
                <!-- Info Kontak -->
                <div class="bg-white rounded-2xl shadow-xl p-8 hover-lift">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-red-200  p-3 rounded-lg">
                                <i class="fas fa-map-marker-alt text-red-900"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Alamat</h4>
                                <p class="text-gray-600"> Jl. surakarta merdeka <br> Surakarta , Jawa Tengah 50241 </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-red-200  p-3 rounded-lg">
                                <i class="fas fa-phone text-red-900"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Telepon</h4>
                                <p class="text-gray-600">+62 821 3474 9670</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-red-200  p-3 rounded-lg">
                                <i class="fas fa-envelope text-red-900"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600">flavorise@gmail.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-red-200 p-3 rounded-lg">
                                <i class="fas fa-clock text-red-900"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 12:00</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Peta (Placeholder) -->
        <div class="mt-16 bg-white rounded-2xl shadow-xl overflow-hidden hover-lift">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800">Lokasi Kami</h3>
            </div>
            <div class="h-96 w- bg-gray-200 flex items-center justify-center ">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5772.609572005833!2d110.74769338159219!3d-7.547632464419571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a148d8d70b9d9%3A0xc1e245d411c6ff6a!2sSTMIK%20AMIKOM%20Surakarta!5e0!3m2!1sid!2sid!4v1753596172933!5m2!1sid!2sid" width="1400" height="384" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </main>


    <script>
        // Function to handle floating labels
        function handleFloatingLabels() {
            const inputs = document.querySelectorAll('.floating-label input, .floating-label textarea');
            
            inputs.forEach(input => {
                // Check on page load
                checkInputValue(input);
                
                // Check on input change
                input.addEventListener('input', () => checkInputValue(input));
                input.addEventListener('blur', () => checkInputValue(input));
                input.addEventListener('focus', () => checkInputValue(input));
            });
        }
        
        function checkInputValue(input) {
            if (input.value.trim() !== '') {
                input.classList.add('has-value');
            } else {
                input.classList.remove('has-value');
            }
        }

        // Form submission handler
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Simple validation
            if (!data.nama || !data.email || !data.pesan) {
                alert('Mohon isi semua field yang wajib diisi.');
                return;
            }
            
            // Simulate form submission
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
            button.disabled = true;
            
            setTimeout(() => {
                alert('Terima kasih! Pesan Anda telah dikirim. Kami akan segera menghubungi Anda.');
                this.reset();
                
                // Reset floating labels after form reset
                const inputs = document.querySelectorAll('.floating-label input, .floating-label textarea');
                inputs.forEach(input => {
                    input.classList.remove('has-value');
                });
                
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);
        });

        // Initialize floating labels when page loads
        document.addEventListener('DOMContentLoaded', handleFloatingLabels);
    </script>

@endsection