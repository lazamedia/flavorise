    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih <span class="text-gradient">Flavorise?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Dapatkan kemudahan mengelola bisnis F&B Anda dengan fitur-fitur canggih yang dirancang khusus untuk kebutuhan restoran modern
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-red-50 to-red-100 card-hover">
                    <div class="w-16 h-16 feature-icon rounded-2xl flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-tachometer-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Performa Tinggi</h3>
                    <p class="text-gray-600">Proses transaksi dalam hitungan detik dengan teknologi cloud computing terdepan</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-blue-90 to-purple-100 card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-900 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-600">Enkripsi end-to-end dan backup otomatis untuk melindungi data bisnis Anda</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Multi User</h3>
                    <p class="text-gray-600">Kelola tim dengan akses bertingkat dan monitoring aktivitas real-time</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-headset text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Support 24/7</h3>
                    <p class="text-gray-600">Tim support profesional siap membantu Anda kapan saja dibutuhkan</p>
                </div>
            </div>
        </div>
    </section>

    <script>

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-slide-up');
                }
            });
        }, observerOptions);

        // Observe all elements with animation classes
        document.querySelectorAll('.card-hover').forEach(el => {
            observer.observe(el);
        });

        // Smooth scroll for CTA buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function() {
                // Add click effect
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // Auto-update stats (demo)
        function updateStats() {
            const statsElements = document.querySelectorAll('.text-2xl.font-bold');
            statsElements.forEach(el => {
                if (el.textContent.includes('K+')) {
                    const currentValue = parseInt(el.textContent.replace(/\D/g, ''));
                    const newValue = currentValue + Math.floor(Math.random() * 5);
                    el.textContent = newValue + 'K+';
                }
            });
        }

        // Update stats every 5 seconds
        setInterval(updateStats, 5000);
    </script>