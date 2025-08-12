

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full z-40 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-gray-200/40 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-40">
            <div class="flex items-center justify-between h-16 z-40">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-900 to-red-500 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <i class="fas fa-utensils text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-red-900 to-red-500 bg-clip-text text-transparent">
                        FLAVORISE
                    </span>
                </div>

                <!-- Desktop Menu -->
                

                <!-- CTA & Mobile Menu Button -->
                <div class="flex items-center space-x-4 gap-10">

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ url('/') }}" class="nav-link text-gray-700 hover:text-red-600 font-medium transition-all duration-300 relative group">
                            Home
                        </a>
                        
                        <a href="{{ url('/fitur') }}" class="nav-link text-gray-700 hover:text-red-600 font-medium transition-all duration-300 relative group">
                            Features
                        </a>
                        
                        <a href="{{ url('/kontak') }}" class="nav-link text-gray-700 hover:text-red-600 font-medium transition-all duration-300 relative group">
                            Contact
                        </a>
                    </div>

                    <!-- Login Button (Desktop) -->
                    @auth
                        <a href="{{ url('/apps') }}" class="hidden md:inline-flex items-center px-6 py-2 bg-gradient-to-r from-red-900 to-red-600 hover:from-red-600 hover:to-red-900 text-white font-medium rounded-lg transition-all duration-300 hover:shadow-lg ">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ url('/login') }}" class="hidden md:inline-flex items-center px-6 py-2 bg-gradient-to-r from-red-900 to-red-600 hover:from-red-600 hover:to-red-900 text-white font-medium rounded-lg transition-all duration-300 hover:shadow-lg ">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <div class="hamburger-lines">
                            <span class="block w-5 h-0.5 bg-gray-600 transition-all duration-300"></span>
                            <span class="block w-5 h-0.5 bg-gray-600 mt-1 transition-all duration-300"></span>
                            <span class="block w-5 h-0.5 bg-gray-600 mt-1 transition-all duration-300"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden fixed inset-0 top-18 z-20  transform translate-x-full transition-transform duration-300">
            <div class="mobile-menu-backdrop  absolute inset-0 "></div>
            <div class="relative bg-white h-full w-80 ml-auto shadow-2xl">
                <div class="p-6 space-y-6 bg-gray-100" >
                    <!-- Mobile Menu Items -->
                    <a href="#home" class="mobile-menu-item block py-3 px-4 text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 font-medium">
                        <i class="fas fa-home mr-3 text-gray-400"></i>
                        Home
                    </a>

                    <!-- Mobile Features Section -->
                    <div class="space-y-2">
                        <div class="py-3 px-4 text-gray-900 font-medium border-b border-gray-100">
                            <i class="fas fa-star mr-3 text-gray-400"></i>
                            Fitur
                        </div>
                        <a href="#web-dev" class="mobile-menu-item block py-2 px-8 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-code mr-3 text-gray-400"></i>
                            Web Development
                        </a>
                        <a href="#mobile-app" class="mobile-menu-item block py-2 px-8 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-mobile-alt mr-3 text-gray-400"></i>
                            Mobile Apps
                        </a>
                        <a href="#ui-design" class="mobile-menu-item block py-2 px-8 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-paint-brush mr-3 text-gray-400"></i>
                            UI/UX Design
                        </a>
                    </div>

                    <a href="#contact" class="mobile-menu-item block py-3 px-4 text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 font-medium">
                        <i class="fas fa-envelope mr-3 text-gray-400"></i>
                        Contact
                    </a>

                    <!-- Mobile Login Button -->
                    <a href="#login" class="block w-full py-3 px-4 bg-gradient-to-r from-red-500 to-purple-600 hover:from-red-600 hover:to-purple-700 text-white font-medium rounded-lg transition-all duration-300 text-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>

                    <!-- Mobile Social Links -->
                    <div class="pt-6 border-t border-gray-100">
                        <p class="text-sm text-gray-500 mb-4">Ikuti Kami</p>
                        <div class="flex space-x-3">
                            <a href="#" class="w-10 h-10 bg-red-100 hover:bg-red-600 text-red-600 hover:text-white rounded-lg flex items-center justify-center transition-all duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-sky-100 hover:bg-sky-500 text-sky-500 hover:text-white rounded-lg flex items-center justify-center transition-all duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-pink-100 hover:bg-pink-600 text-pink-600 hover:text-white rounded-lg flex items-center justify-center transition-all duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerLines = mobileMenuBtn.querySelector('.hamburger-lines').children;
        let isMenuOpen = false;

        mobileMenuBtn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            
            if (isMenuOpen) {
                mobileMenu.classList.remove('translate-x-full');
                mobileMenu.classList.add('translate-x-0');
                
                // Animate hamburger to X
                hamburgerLines[0].style.transform = 'rotate(45deg) translate(3px, 3px)';
                hamburgerLines[1].style.opacity = '0';
                hamburgerLines[2].style.transform = 'rotate(-45deg) translate(4px, -4px)';
                
                document.body.style.overflow = 'hidden';
            } else {
                mobileMenu.classList.add('translate-x-full');
                mobileMenu.classList.remove('translate-x-0');
                
                // Reset hamburger
                hamburgerLines[0].style.transform = 'none';
                hamburgerLines[1].style.opacity = '1';
                hamburgerLines[2].style.transform = 'none';
                
                document.body.style.overflow = 'auto';
            }
        });

        // Close mobile menu when clicking on backdrop
        mobileMenu.addEventListener('click', (e) => {
            if (e.target.classList.contains('mobile-menu-backdrop')) {
                mobileMenuBtn.click();
            }
        });

        // Close mobile menu when clicking on menu items
        document.querySelectorAll('.mobile-menu-item').forEach(item => {
            item.addEventListener('click', () => {
                if (isMenuOpen) {
                    mobileMenuBtn.click();
                }
            });
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.remove('bg-white/90');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.add('bg-white/90');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Active nav link highlighting
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-red-600');
                link.classList.add('text-gray-700');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('text-red-600');
                    link.classList.remove('text-gray-700');
                }
            });
        });
    </script>
