<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dokumentasi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Prism.js CSS - VSCode Dark Theme -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-vsc-dark-plus.min.css" rel="stylesheet" />
    
    <!-- Prism.js Core -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',   // merah muda
                            500: '#ef4444',  // merah sedang
                            600: '#dc2626',  // merah lebih gelap
                            700: '#b91c1c'   // merah gelap
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .code-block {
            background: #1e293b;
            color: #e2e8f0;
            border-radius: 0.5rem;
            padding: 1rem;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .highlight {
            background: rgba(59, 130, 246, 0.1);
            border-left: 4px solid #dc2626;
            padding: 1rem;
            margin: 1rem 0;
        }
        .nav-link.active {
            background: #dc2626;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a 
                        href="/"
                        class="text-xl font-bold text-primary-600">
                        FLAVORISE
                    </a>
                </div>
                <nav class="hidden md:flex space-x-8 content-center items-center">
                    {{-- <a href="#overview" class="text-gray-700 hover:text-primary-600">Overview</a> --}}
                    <a href="#installation" class="text-gray-700 hover:text-primary-600">Instalasi</a>
                    <a href="#architecture" class="text-gray-700 hover:text-primary-600">Arsitektur</a>
                    {{-- <a href="#controllers" class="text-gray-700 hover:text-primary-600">Controllers</a> --}}
                    <a href="#features" class="text-gray-700 hover:text-primary-600">Fitur</a>
                    <a 
                    href="https://github.com/lazamedia/flavorise" class="px-5 py-1 rounded border border-slate-800 bg-slate-900 text-white"
                    target="_blank"
                    >
                        <i class="fab fa-github mr-1"></i> Github
                    </a>
                    
                </nav>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:flex lg:gap-8">
            <!-- Sidebar -->
            <aside class="lg:w-64 lg:flex-shrink-0 mb-8 lg:mb-0">
                <div class="sticky top-24">
                    <div class="bg-white rounded-lg shadow-sm border p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">Daftar Isi</h3>
                        <nav class="space-y-2">

                            <a href="#overview" 
                            class="nav-link block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 border border-gray-50 hover:border-red-500 rounded">
                                1. Overview
                            </a>

                            <a href="#installation" 
                            class="nav-link block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 border border-gray-50 hover:border-red-500 rounded">
                                2. Instalasi
                            </a>

                            <a href="#architecture" 
                            class="nav-link block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 border border-gray-50 hover:border-red-500 rounded">
                                3. Arsitektur
                            </a>

                            <a href="#controllers" 
                            class="nav-link block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 border border-gray-50 hover:border-red-500 rounded">
                                4. Controllers
                            </a>

                            <div class="ml-4 space-y-1">
                                <a 
                                href="#auth-controller" 
                                class="block px-3 py-1 text-xs text-gray-600 hover:text-primary-600">
                                    AuthController
                                </a>
                                <a 
                                href="#pos-controller" 
                                class="block px-3 py-1 text-xs text-gray-600 hover:text-primary-600">
                                    PosController
                                </a>
                                <a 
                                href="#shift-controller" 
                                class="block px-3 py-1 text-xs text-gray-600 hover:text-primary-600">
                                    ShiftController
                                </a>
                                <a 
                                href="#transaction-controller" 
                                class="block px-3 py-1 text-xs text-gray-600 hover:text-primary-600">
                                    TransactionController
                                </a>
                                <a 
                                href="#report-controller" 
                                class="block px-3 py-1 text-xs text-gray-600 hover:text-primary-600">
                                    ReportController
                                </a>
                                <a 
                                href="#other-controllers" 
                                class="block px-3 py-1 text-xs text-gray-600 hover:text-primary-600">
                                    Other Controllers
                                </a>
                            </div>

                            <a href="#features" 
                             class="nav-link block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 border border-gray-50 hover:border-red-500 rounded">
                                5. Fitur Sistem
                            </a>

                            <a href="#security" 
                             class="nav-link block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 border border-gray-50 hover:border-red-500 rounded">
                                6. Keamanan
                            </a>

                            {{-- <a href="#api"
                             class="nav-link block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 border border-gray-50 hover:border-red-500 rounded">
                                7. API Reference
                            </a> --}}

                        </nav>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="lg:flex-1 min-w-0">
                <!-- Overview Section -->
                <section id="overview" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">

                        <h2 class="text-3xl font-bold text-gray-900 mb-6">
                            Overview Sistem
                        </h2>
                        
                        <div class="prose max-w-none">
                            
                            <p class="text-lg text-gray-700 mb-6">
                                Sistem Flavorise adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola transaksi penjualan, inventori, dan laporan keuangan untuk usaha retail atau restoran.
                            </p>
                            
                            <div class="grid md:grid-cols-2 gap-6 mb-8">
                                <div class="bg-blue-50 p-6 rounded-lg">
                                    <h3 class="font-semibold text-blue-900 mb-3">Tujuan Sistem</h3>
                                    <ul class="space-y-2 text-blue-800">

                                        <li>
                                            • Memudahkan proses transaksi penjualan
                                        </li>
                                        <li>
                                            • Mengelola inventori produk
                                        </li>
                                        <li>
                                            • Menghasilkan laporan keuangan
                                        </li>
                                        <li>
                                            • Manajemen shift kasir
                                        </li>
                                        <li>
                                            • Kontrol pengeluaran operasional
                                        </li>

                                    </ul>
                                </div>
                                
                                <div class="bg-green-50 p-6 rounded-lg">
                                    <h3 class="font-semibold text-green-900 mb-3">Fitur Utama</h3>
                                    <ul class="space-y-2 text-green-800">
                                        <li>• Manajemen Menu & Kategori</li>
                                        <li>• Sistem POS Real-time</li>
                                        <li>• Manajemen Shift Kasir</li>
                                        <li>• Laporan Penjualan</li>
                                        <li>• Manajemen Pengeluaran</li>
                                        <li>• Multi-payment Method</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="highlight">
                                <h4 class="font-semibold mb-2">Teknologi yang Digunakan</h4>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                                    <div class="text-center">
                                        <div class="bg-red-100 p-3 rounded">Laravel 12+</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="bg-blue-100 p-3 rounded">MySQL</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="bg-yellow-100 p-3 rounded">Blade Templates</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="bg-green-100 p-3 rounded">TailwindCSS</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Installation Section -->
                <section id="installation" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Panduan Instalasi</h2>
                        
                        <div class="space-y-8">
                            <div>
                                {{-- <h3 class="text-xl font-semibold text-gray-900 mb-4">Prerequisites</h3> --}}
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-yellow-800 mb-2">Requirement Sistem:</h4>
                                    <ul class="list-disc list-inside text-yellow-700 space-y-1">
                                        <li>PHP >= 8.1          </li>
                                        <li>Composer            </li>
                                        <li>Node.js & NPM       </li>
                                        <li>MySQL               </li>
                                        {{-- <li>Web Server (Apache/Nginx)</li> --}}
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Langkah Instalasi</h3>
                                
                                <div class="space-y-6">
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">1. Clone Repository</h4>
                                        <div class="code-block">
git clone https://github.com/lazamedia/flavorise.git
cd flavorise
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">2. Install Dependencies</h4>
                                        <div class="code-block">
composer install

# Install Node dependencies (optional)
npm init
npm install
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">3. Environment Setup</h4>
                                        <div class="code-block">
cp .env.example .env

# Generate application key
php artisan key:generate

                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">4. Database Configuration</h4>
                                        <p class="text-gray-600 mb-2">Edit file <code class="bg-gray-100 px-2 py-1 rounded">.env</code> dan sesuaikan konfigurasi database:</p>
                                        <div class="code-block">
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flavorise
DB_USERNAME=root
DB_PASSWORD= 
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">5. Database Migration & Seeding</h4>
                                        <div class="code-block">
php artisan migrate --seed
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">6. Storage Link</h4>
                                        <div class="code-block">
php artisan storage:link
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">7. Build Assets</h4>
                                        <div class="code-block">
# Development
npm run dev

# Production
npm run build
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">8. Start Development Server</h4>
                                        <div class="code-block">
# Start Laravel development server
php artisan serve

# Akses aplikasi di: http://localhost:8000
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-800 mb-2"> Verifikasi Instalasi</h4>
                                <p class="text-gray-700">Setelah instalasi selesai, buka browser dan akses <code>http://localhost:8000</code>. Login dengan:</p>
                                <div class="mt-2 code-block bg-gray-900">
Username: admin
Password: password123
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Architecture Section -->
                <section id="architecture" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Arsitektur Sistem</h2>
                        
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Pattern MVC (Model-View-Controller)</h3>
                                <p class="text-gray-700 mb-4">Sistem menggunakan pola arsitektur MVC Laravel dengan struktur yang terorganisir:</p>
                                
                                <div class="grid md:grid-cols-3 gap-6">
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-blue-900 mb-2"> Models</h4>
                                        <ul class="text-sm text-blue-800 space-y-1">
                                            <li>• User</li>
                                            <li>• Menu</li>
                                            <li>• Category</li>
                                            <li>• Transaction</li>
                                            <li>• TransactionItem</li>
                                            <li>• Shift</li>
                                            <li>• Expense</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-green-900 mb-2"> Views</h4>
                                        <ul class="text-sm text-green-800 space-y-1">
                                            <li>• Blade Templates</li>
                                            <li>• Component Reusable</li>
                                            <li>• Layout System</li>
                                            <li>• Real-time Updates</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-yellow-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-yellow-900 mb-2"> Controllers</h4>
                                        <ul class="text-sm text-yellow-800 space-y-1">
                                            <li>• AuthController</li>
                                            <li>• PosController</li>
                                            <li>• ShiftController</li>
                                            <li>• TransactionController</li>
                                            <li>• ReportController</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Database Schema</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold mb-3">Tabel Utama:</h4>
                                    <div class="grid md:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <strong>users:</strong> Data pengguna dan kasir<br>
                                            <strong>categories:</strong> Kategori produk<br>
                                            <strong>menus:</strong> Data produk/menu<br>
                                            <strong>shifts:</strong> Data shift kerja kasir
                                        </div>
                                        <div>
                                            <strong>transactions:</strong> Header transaksi<br>
                                            <strong>transaction_items:</strong> Detail item transaksi<br>
                                            <strong>expenses:</strong> Data pengeluaran<br>
                                            <strong>cash_movements:</strong> Pergerakan kas
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Flow Sistem</h3>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="flex flex-wrap items-center justify-center space-x-4 text-sm">
                                        <div class="bg-blue-100 px-3 py-2 rounded">Login</div>
                                        <span>→</span>
                                        <div class="bg-green-100 px-3 py-2 rounded">Buka Shift</div>
                                        <span>→</span>
                                        <div class="bg-yellow-100 px-3 py-2 rounded">POS Interface</div>
                                        <span>→</span>
                                        <div class="bg-purple-100 px-3 py-2 rounded">Checkout</div>
                                        <span>→</span>
                                        <div class="bg-red-100 px-3 py-2 rounded">Print Receipt</div>
                                        <span>→</span>
                                        <div class="bg-gray-100 px-3 py-2 rounded">Close Shift</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Controllers Section -->
                <section id="controllers" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Analisis Controllers</h2>
                        
                        <!-- AuthController -->
                        <div id="auth-controller" class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4"> AuthController</h3>
                            <p class="text-gray-700 mb-4">Mengatur sistem autentikasi dengan fitur keamanan canggih termasuk rate limiting dan pencegahan brute force attack.</p>
                            
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: authenticate()</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Fungsi  : </strong> Memproses login user dengan validasi keamanan<br>
                                        <strong>Logic   :  </strong>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>
                                                <span class="text-blue-600">
                                                    Rate Limiting:
                                                </span> 
                                                Membatasi percobaan login per IP menggunakan Laravel RateLimiter
                                            </li>
                                            <li>
                                                <span class="text-green-600">
                                                    Validation:
                                                </span> 
                                                Validasi input dengan regex pattern untuk username
                                            </li>
                                            <li>
                                                <span class="text-yellow-600">
                                                    Throttling:
                                                </span> 
                                                Sistem blokir bertahap (1 menit → 30 menit)
                                            </li>
                                            <li>
                                                <span class="text-red-600">
                                                    Security:
                                                </span> 
                                                Hash password verification dan session regeneration
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <h5 class="font-medium mb-2">Key Code Analysis:</h5>
                                        <div class="code-block">
// Rate limiting dengan key unik per IP + User Agent 
$throttleKey = $this->throttleKey($request);
$attemptsKey = 'login_attempts:' . $throttleKey;<br>

// Cek blokir IP dengan escalating timeout
if (RateLimiter::tooManyAttempts($blockKey, 1)) {
    $seconds = RateLimiter::availableIn($blockKey);
    // Blokir dengan pesan error yang informatif
}

// Validasi kredensial dengan Auth::attempt()
$loginAttempt = Auth::attempt([
    'username' => $credentials['username'],
    'password' => $credentials['password']
], $request->boolean('remember')); 
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: handleFailedLogin()</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Logic Escalation (Sistem Blokir Bertingkat) :</strong>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>Max 3 attempts per cycle</li>
                                            <li>Block duration: 1 min → 2 min → ... → 30 min (max)</li>
                                            <li>Counter reset setelah 40 menit (decay time)</li>
                                            <li>Informasi sisa percobaan untuk user experience</li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: logout()</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Security Features : </strong>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>Cek active shift sebelum logout (business logic)</li>
                                            <li>Revoke semua API tokens (Sanctum integration)</li>
                                            <li>Session invalidation dan regeneration</li>
                                            <li>Comprehensive logging untuk audit trail (Catat Aktivitas)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PosController -->
                        <div id="pos-controller" class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4">PosController</h3>
                            <p class="text-gray-700 mb-4">Controller utama untuk sistem Point of Sale, menangani interface kasir dan proses checkout.</p>
                            
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: index()</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Business Logic:</strong>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li><span class="text-blue-600">User Detection:</span> Auto-detect user ID (auth atau fallback ke first user)</li>
                                            <li><span class="text-green-600">Shift Validation:</span> Wajib ada active shift untuk akses POS</li>
                                            <li><span class="text-yellow-600">Data Loading:</span> Eager loading menu dengan kategori untuk performa</li>
                                            <li><span class="text-red-600">Redirect Logic:</span> Auto redirect ke shift management jika belum buka shift</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <div class="code-block">
// Fallback user detection untuk demo mode
$userId = auth()->id() ?: optional(\App\Models\User::orderBy('id')->first())->id;

// Validasi active shift (business requirement)
$activeShift = $userId ? \App\Models\Shift::where('user_id', $userId)->active()->first() : null;

if (!$activeShift) {
    return redirect()->route('apps.shifts.index')
        ->with('success', 'Buka shift terlebih dahulu untuk mengakses POS.');
}

// Optimized data loading
$menus = Menu::with('category')->available()->orderByDesc('created_at')->get();
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: checkout()</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Complex Transaction Logic:</strong>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li><span class="text-blue-600">Validation Layer:</span> Multi-level validation (format, business rules, data integrity)</li>
                                            <li><span class="text-green-600">Price Verification:</span> Server-side price validation dengan tolerance floating point</li>
                                            <li><span class="text-yellow-600">Payment Logic:</span> Conditional validation berdasarkan payment method</li>
                                            <li><span class="text-red-600">Atomic Transaction:</span> Database transaction untuk data consistency</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <h5 class="font-medium mb-2">Validation Rules Analysis:</h5>
                                        <div class="code-block">
// Frontend cart validation
$data = $request->validate([
    'cart' => ['required', 'array', 'min:1'],
    'cart.*.menu_id' => ['required', 'exists:menus,id'],
    'cart.*.quantity' => ['required', 'integer', 'min:1'],
    'cart.*.unit_price' => ['required', 'numeric', 'min:0'],
    'payment_method' => ['required', 'in:cash,qris'],
    'paid_amount' => ['required', 'numeric', 'min:0'],
    // ... other fields
]);

// Business validation - payment amount
if ($paymentMethod === 'cash' && $paidAmount < $total) {
    return response()->json([
        'success' => false,
        'message' => 'Uang yang dibayarkan tidak cukup'
    ], 400);
}

// Price integrity check dengan floating point tolerance
foreach ($cart as $item) {
    if (abs($menu->price - $item['unit_price']) > 0.01) {
        return response()->json([
            'success' => false,
            'message' => 'Harga menu tidak sesuai: ' . $menu->name
        ], 400);
    }
}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ShiftController -->
                        <div id="shift-controller" class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4"> ShiftController</h3>
                            <p class="text-gray-700 mb-4">Mengelola shift kerja kasir dengan sistem kontrol akses dan cash management.</p>
                            
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: index() - Access Control</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Role-based Access Control:</strong>
                                        <div class="code-block">
// Admin dapat melihat semua shift
$isAdmin = $currentUser?->isAdmin() ?? false;

// User biasa hanya melihat shift sendiri
if (!$isAdmin && $currentUserId) {
    $query->where('user_id', $currentUserId);
}

// Pagination dengan query string preservation
$shifts = $query->paginate(12)->withQueryString(); 
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: canAccessShift() - Security Layer</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Authorization Logic:</strong>
                                        <div class="code-block">
private function canAccessShift(Shift $shift): bool
{
    $user = auth()->user();
    if (!$user) {
        return false; // Unauthenticated access denied
    }
    
    // Admin universal access
    if ($user->isAdmin()) {
        return true;
    }
    
    // Regular user - own shifts only
    return $shift->user_id === $user->id;
} 
                                        </div>
                                        <p class="mt-2 text-gray-600">Method ini memastikan setiap shift hanya dapat diakses oleh pemiliknya atau admin.</p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: store() - Shift Creation Logic</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Business Rules:</strong>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>Satu user hanya boleh memiliki satu active shift</li>
                                            <li>Auto-generate shift date dan start time</li>
                                            <li>Opening cash default 0 jika tidak diisi</li>
                                            <li>Status otomatis 'active'</li>
                                        </ul>
                                        <div class="code-block mt-3">
// Prevent multiple active shifts
$existing = Shift::where('user_id', $userId)->active()->first();
if ($existing) {
    return redirect()->route('apps.shifts.index')
        ->with('success', 'Masih ada shift aktif.');
}

// Create new shift dengan timestamp otomatis
Shift::create([
    'user_id' => $userId,
    'shift_date' => now()->toDateString(),
    'start_time' => now()->format('H:i'),
    'opening_cash' => (float) ($data['opening_cash'] ?? 0),
    'status' => 'active',
]);
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TransactionController -->
                        <div id="transaction-controller" class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4"> TransactionController</h3>
                            <p class="text-gray-700 mb-4">Mengelola riwayat transaksi, pencarian, dan operasi void dengan stock restoration.</p>
                            
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: index() - Advanced Search</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Search & Filter Logic:</strong>
                                        <div class="code-block">
// Multi-field search dengan OR condition
if ($request->filled('q')) {
    $q = $request->q;
    $query->where(function ($sub) use ($q) {
        $sub->where('transaction_code', 'like', '%'.$q.'%')
            ->orWhere('customer_notes', 'like', '%'.$q.'%');
    });
}

// Filter berdasarkan payment method
if ($request->filled('payment_method')) {
    $query->where('payment_method', $request->payment_method);
}

// Pagination dengan query string preservation
$transactions = $query->paginate(12)->withQueryString();
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: void() - Transaction Cancellation</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Stock Restoration Logic:</strong>
                                        <div class="code-block">
// Restore stock untuk setiap item yang dibatalkan
foreach ($transaction->items as $item) {
    if ($item->menu) {
        $item->menu->stock += $item->quantity;
        $item->menu->save();
    }
}

// Update status transaksi
$transaction->status = 'cancelled';
$transaction->save();

// Recalculate shift totals
if ($transaction->shift) {
    $transaction->shift->calculateTotalSales();
}
                                        </div>
                                        <p class="mt-2 text-gray-600">Method ini memastikan konsistensi inventory saat transaksi dibatalkan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ReportController -->
                        <div id="report-controller" class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4"> ReportController</h3>
                            <p class="text-gray-700 mb-4">Menghasilkan laporan komprehensif dengan analitik penjualan dan export functionality.</p>
                            
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Method: sales() - Comprehensive Analytics</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Multi-dimensional Analysis:</strong>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li><span class="text-blue-600">Time-based:</span> Default current month, custom date range</li>
                                            <li><span class="text-green-600">Payment Analysis:</span> Breakdown by payment method</li>
                                            <li><span class="text-yellow-600">Category Performance:</span> Sales by product category</li>
                                            <li><span class="text-red-600">Product Ranking:</span> Top-selling items</li>
                                            <li><span class="text-purple-600">Daily Trends:</span> Day-by-day sales pattern</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <h5 class="font-medium mb-2">Complex Query Analysis:</h5>
                                        <div class="code-block">
// Sales by category dengan multiple JOIN
$byCategory = TransactionItem::query()
    ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
    ->join('menus', 'transaction_items.menu_id', '=', 'menus.id')
    ->join('categories', 'menus.category_id', '=', 'categories.id')
    ->whereBetween('transactions.created_at', [$startDate, $endDate])
    ->groupBy('categories.id', 'categories.name')
    ->select('categories.name as category_label', DB::raw('SUM(transaction_items.total_price) as total'))
    ->orderByDesc('total')
    ->get();

// Top selling products dengan quantity dan revenue
$topMenus = TransactionItem::query()
    ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
    ->join('menus', 'transaction_items.menu_id', '=', 'menus.id')
    ->groupBy('menus.id', 'menus.name')
    ->select('menus.name as product_name', 
             DB::raw('SUM(transaction_items.quantity) as qty'), 
             DB::raw('SUM(transaction_items.total_price) as total'))
    ->orderByDesc('total')
    ->limit(10) 
    ->get();
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">CSV Export Feature</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg text-sm">
                                        <strong>Export Logic:</strong>
                                        <div class="code-block">
// CSV export dengan memory-efficient streaming
if ($request->get('export') === 'csv') {
    $rows = [['Tanggal', 'Kode', 'Metode', 'Total']];
    
    // Cursor untuk large dataset (memory efficient)
    foreach ($transactionsQuery->clone()->orderBy('created_at')->cursor() as $trx) {
        $rows[] = [
            $trx->created_at->format('Y-m-d H:i'),
            $trx->transaction_code,
            strtoupper($trx->payment_method),
            (string) $trx->total,
        ];
    }
    
    // Stream CSV response
    $handle = fopen('php://temp', 'r+');
    foreach ($rows as $row) { fputcsv($handle, $row); }
    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);
    
    return response($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="sales-report.csv"'
    ]);
}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Other Controllers -->
                        <div id="other-controllers" class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Controllers Lainnya</h3>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="bg-blue-50 p-6 rounded-lg">
                                    <h4 class="font-semibold text-blue-900 mb-3"> CategoryController</h4>
                                    <ul class="text-sm text-blue-800 space-y-2">
                                        <li><strong>CRUD Operations:</strong> Standard create, read, update, delete</li>
                                        <li><strong>Image Handling:</strong> Upload, storage, dan deletion dengan Storage facade</li>
                                        <li><strong>Validation:</strong> Image size limit (2MB), format validation</li>
                                        <li><strong>Status Toggle:</strong> Active/inactive category management</li>
                                    </ul>
                                </div>

                                <div class="bg-green-50 p-6 rounded-lg">
                                    <h4 class="font-semibold text-green-900 mb-3"> MenuController</h4>
                                    <ul class="text-sm text-green-800 space-y-2">
                                        <li><strong>Product Management:</strong> CRUD dengan kategori relationship</li>
                                        <li><strong>Stock Control:</strong> Integer validation untuk stock management</li>
                                        <li><strong>Price Management:</strong> Numeric validation dengan min value</li>
                                        <li><strong>Availability Toggle:</strong> Product availability control</li>
                                    </ul>
                                </div>

                                <div class="bg-yellow-50 p-6 rounded-lg">
                                    <h4 class="font-semibold text-yellow-900 mb-3"> UserController</h4>
                                    <ul class="text-sm text-yellow-800 space-y-2">
                                        <li><strong>User Management:</strong> Create kasir dan admin users</li>
                                        <li><strong>Role System:</strong> Admin/kasir role differentiation</li>
                                        <li><strong>Unique Validation:</strong> Username dan email uniqueness</li>
                                        <li><strong>Password Security:</strong> Bcrypt hashing, optional update</li>
                                    </ul>
                                </div>

                                <div class="bg-purple-50 p-6 rounded-lg">
                                    <h4 class="font-semibold text-purple-900 mb-3"> ExpenseController</h4>
                                    <ul class="text-sm text-purple-800 space-y-2">
                                        <li><strong>Expense Tracking:</strong> Kategorisasi pengeluaran operasional</li>
                                        <li><strong>Receipt Management:</strong> Upload dan storage receipt images</li>
                                        <li><strong>Date Filtering:</strong> Period-based expense reporting</li>
                                        <li><strong>Category System:</strong> operational, supplies, maintenance, other</li>
                                    </ul>
                                </div>

                                <div class="bg-red-50 p-6 rounded-lg">
                                    <h4 class="font-semibold text-red-900 mb-3"> DashboardController</h4>
                                    <ul class="text-sm text-red-800 space-y-2">
                                        <li><strong>Real-time Metrics:</strong> Today sales, monthly profit</li>
                                        <li><strong>Performance Analytics:</strong> Best day, top products</li>
                                        <li><strong>Operational Status:</strong> Active shifts, low stock alerts</li>
                                        <li><strong>Payment Breakdown:</strong> Cash vs QRIS analysis</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Features Section -->
                <section id="features" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Fitur Sistem Lengkap</h2>
                        
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">1. Sistem Autentikasi</h3>
                                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                                    <h4 class="font-semibold text-red-800 mb-2">🛡️ Security Features</h4>
                                    <ul class="list-disc list-inside text-red-700 space-y-1">
                                        <li><strong>Rate Limiting:</strong> Max 3 attempts per 40 menit</li>
                                        <li><strong>Progressive Blocking:</strong> 1 min → 30 min escalation</li>
                                        <li><strong>IP-based Throttling:</strong> Per IP + User Agent combination</li>
                                        <li><strong>Session Security:</strong> Auto-regeneration pada login/logout</li>
                                        <li><strong>Password Hashing:</strong> Bcrypt dengan salt</li>
                                        <li><strong>Remember Me:</strong> Persistent login functionality</li>
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">2. Sistem POS (Point of Sale)</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2"> Cart Management</h4>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>Frontend-based cart (no server sessions)</li>
                                            <li>Real-time price calculation</li>
                                            <li>Quantity adjustment</li>
                                            <li>Tax dan discount handling</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2"> Payment Processing</h4>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>Cash payment dengan change calculation</li>
                                            <li>QRIS digital payment</li>
                                            <li>Payment validation</li>
                                            <li>Receipt generation</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">3. Manajemen Shift</h3>
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-blue-900 mb-2"> Shift Workflow</h4>
                                    <div class="text-blue-800 space-y-2">
                                        <p><strong>Buka Shift:</strong> Input opening cash, auto-generate start time</p>
                                        <p><strong>Selama Shift:</strong> Cash in/out tracking, transaction recording</p>
                                        <p><strong>X-Report:</strong> Mid-shift sales report (tidak menutup shift)</p>
                                        <p><strong>Z-Report:</strong> End-of-shift final report</p>
                                        <p><strong>Tutup Shift:</strong> Input closing cash, calculate variance</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">4. Inventory Management</h3>
                                <div class="grid md:grid-cols-3 gap-4">
                                    <div class="bg-green-50 p-4 rounded">
                                        <h4 class="font-semibold text-green-900 mb-2"> Menu Management</h4>
                                        <ul class="text-sm text-green-800 space-y-1">
                                            <li>• CRUD operations</li>
                                            <li>• Image upload</li>
                                            <li>• Stock tracking</li>
                                            <li>• Price management</li>
                                            <li>• Availability toggle</li>
                                        </ul>
                                    </div>
                                    <div class="bg-yellow-50 p-4 rounded">
                                        <h4 class="font-semibold text-yellow-900 mb-2"> Category System</h4>
                                        <ul class="text-sm text-yellow-800 space-y-1">
                                            <li>• Hierarchical organization</li>
                                            <li>• Category images</li>
                                            <li>• Active/inactive status</li>
                                            <li>• Menu grouping</li>
                                        </ul>
                                    </div>
                                    <div class="bg-purple-50 p-4 rounded">
                                        <h4 class="font-semibold text-purple-900 mb-2"> Stock Alerts</h4>
                                        <ul class="text-sm text-purple-800 space-y-1">
                                            <li>• Low stock warnings</li>
                                            <li>• Auto stock deduction</li>
                                            <li>• Stock restoration (void)</li>
                                            <li>• Inventory reports</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">5. Reporting System</h3>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-3"> Sales Analytics</h4>
                                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                                <li>Total sales dan transaction count</li>
                                                <li>Average ticket size calculation</li>
                                                <li>Payment method breakdown</li>
                                                <li>Category performance analysis</li>
                                                <li>Top-selling products ranking</li>
                                                <li>Daily sales trends</li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-3"> Financial Reports</h4>
                                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                                <li>Profit calculation (Sales - Expenses)</li>
                                                <li>Expense categorization</li>
                                                <li>Cash flow tracking</li>
                                                <li>Period-based filtering</li>
                                                <li>CSV export functionality</li>
                                                <li>Dashboard real-time metrics</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Security Section -->
                <section id="security" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Sistem Keamanan</h2>
                        
                        <div class="space-y-8">
                            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-red-900 mb-4"> Authentication Security</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="font-semibold text-red-800 mb-2">Rate Limiting Algorithm</h4>
                                        <div class="code-block">
// Constants untuk security configuration
protected const MAX_ATTEMPTS = 3;           // Max attempts per cycle
protected const ATTEMPT_DECAY_SECONDS = 2400; // 40 menit reset
protected const BLOCK_INCREMENT_SECONDS = 60;  // 1 menit base block
protected const BLOCK_MAX_SECONDS = 1800;     // 30 menit max block

// Progressive blocking calculation
$blockCount = intdiv($currentAttempts, self::MAX_ATTEMPTS);
$blockSeconds = min(self::BLOCK_INCREMENT_SECONDS * $blockCount, self::BLOCK_MAX_SECONDS);
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-semibold text-red-800 mb-2">Throttle Key Generation</h4>
                                        <div class="code-block">
// Unique key per IP + User Agent untuk prevent bypass
protected function throttleKey(Request $request): string
{
    return Str::transliterate(Str::lower(
        $request->ip() . '|' . $request->header('User-Agent')
    ));
}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-blue-900 mb-4"> Authorization System</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="font-semibold text-blue-800 mb-2">Role-based Access Control</h4>
                                        <ul class="list-disc list-inside text-blue-700 space-y-1">
                                            <li><strong>Admin Role:</strong> Full system access, can view all shifts dan transactions</li>
                                            <li><strong>Kasir Role:</strong> Limited access, hanya shift dan transaction sendiri</li>
                                            <li><strong>Shift Isolation:</strong> User hanya bisa akses shift miliknya</li>
                                            <li><strong>Method-level Protection:</strong> Setiap method memiliki authorization check</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-green-900 mb-4"> Data Protection</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="font-semibold text-green-800 mb-2">Input Validation</h4>
                                        <ul class="list-disc list-inside text-green-700 space-y-1">
                                            <li><strong>Laravel Validation:</strong> Server-side validation untuk semua input</li>
                                            <li><strong>Type Casting:</strong> Strict type conversion (int, float, bool)</li>
                                            <li><strong>SQL Injection Prevention:</strong> Eloquent ORM query builder</li>
                                            <li><strong>XSS Protection:</strong> Blade template auto-escaping</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- API Reference -->
                

                <!-- Code Examples -->
                <section id="examples" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Contoh Implementasi</h2>
                        
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Transaction Processing Flow</h3>
                                <div class="code-block">
// 1. Validasi shift aktif
$activeShift = Shift::where('user_id', $userId)->active()->first();
if (!$activeShift) {
    // Auto-create shift jika belum ada
    $shift = Shift::create([
        'user_id' => $userId,
        'shift_date' => now()->toDateString(),
        'start_time' => now()->format('H:i'),
        'opening_cash' => 0,
        'status' => 'active',
    ]);
}

// 2. Validasi cart dan harga
$menuIds = collect($cart)->pluck('menu_id');
$menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

foreach ($cart as $item) {
    $menu = $menus->get($item['menu_id']);
    // Price integrity check dengan floating point tolerance
    if (abs($menu->price - $item['unit_price']) > 0.01) {
        throw new ValidationException('Harga tidak sesuai');
    }
}

// 3. Create transaction dengan database transaction
DB::transaction(function () use ($data) {
    $transaction = Transaction::create([...]);
    
    foreach ($cart as $item) {
        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'menu_id' => $item['menu_id'],
            'quantity' => $item['quantity'],
            'unit_price' => $item['unit_price'],
            'total_price' => $item['quantity'] * $item['unit_price'],
        ]);
    }
});
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Advanced Query Examples</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">Sales by Category (Multiple JOINs)</h4>
                                        <div class="code-block">
// Complex aggregation query untuk category performance
$byCategory = TransactionItem::query()
    ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
    ->join('menus', 'transaction_items.menu_id', '=', 'menus.id')
    ->join('categories', 'menus.category_id', '=', 'categories.id')
    ->whereBetween('transactions.created_at', [$startDate, $endDate])
    ->groupBy('categories.id', 'categories.name')
    ->select(
        'categories.name as category_label', 
        DB::raw('SUM(transaction_items.total_price) as total')
    )
    ->orderByDesc('total')
    ->get();
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">Daily Sales Trend</h4>
                                        <div class="code-block">
// Time-series data untuk chart visualization
$daily = Transaction::query()
    ->whereBetween('created_at', [$startDate, $endDate])
    ->groupBy(DB::raw('DATE(created_at)'))
    ->select(
        DB::raw('DATE(created_at) as date'), 
        DB::raw('SUM(total) as total')
    )
    ->orderBy('date')
    ->get();
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Database Design -->
                <section id="database" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Database Design</h2>
                        
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Entity Relationship</h3>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-3">Core Entities</h4>
                                            <div class="space-y-3 text-sm">
                                                <div class="border-l-4 border-blue-400 pl-3">
                                                    <strong>users</strong><br>
                                                    <span class="text-gray-600">id, username, email, password, role, is_active</span>
                                                </div>
                                                <div class="border-l-4 border-green-400 pl-3">
                                                    <strong>categories</strong><br>
                                                    <span class="text-gray-600">id, name, description, image, is_active</span>
                                                </div>
                                                <div class="border-l-4 border-yellow-400 pl-3">
                                                    <strong>menus</strong><br>
                                                    <span class="text-gray-600">id, category_id, name, price, stock, is_available</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-3">Transaction Entities</h4>
                                            <div class="space-y-3 text-sm">
                                                <div class="border-l-4 border-purple-400 pl-3">
                                                    <strong>shifts</strong><br>
                                                    <span class="text-gray-600">id, user_id, shift_date, start_time, end_time, opening_cash, closing_cash</span>
                                                </div>
                                                <div class="border-l-4 border-red-400 pl-3">
                                                    <strong>transactions</strong><br>
                                                    <span class="text-gray-600">id, user_id, shift_id, subtotal, tax, discount, total, payment_method</span>
                                                </div>
                                                <div class="border-l-4 border-indigo-400 pl-3">
                                                    <strong>transaction_items</strong><br>
                                                    <span class="text-gray-600">id, transaction_id, menu_id, quantity, unit_price, total_price</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Relationships</h3>
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <div class="code-block">
// User → Shifts (One to Many)
User::hasMany(Shift::class)
Shift::belongsTo(User::class)

// User → Transactions (One to Many)
User::hasMany(Transaction::class)
Transaction::belongsTo(User::class)

// Shift → Transactions (One to Many)
Shift::hasMany(Transaction::class)
Transaction::belongsTo(Shift::class)

// Category → Menus (One to Many)
Category::hasMany(Menu::class)
Menu::belongsTo(Category::class)

// Transaction → TransactionItems (One to Many)
Transaction::hasMany(TransactionItem::class, 'transaction_id')
TransactionItem::belongsTo(Transaction::class)

// Menu → TransactionItems (One to Many)
Menu::hasMany(TransactionItem::class)
TransactionItem::belongsTo(Menu::class)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Configuration -->
                <section id="configuration" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Konfigurasi Sistem</h2>
                        
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Environment Variables</h3>
                                <div class="code-block">
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos_system
DB_USERNAME=root
DB_PASSWORD=

# Application Settings
APP_NAME="Sistem Kasir POS"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost

# File Storage
FILESYSTEM_DISK=public

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file

# Mail Configuration (untuk notifications)
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Deployment Configuration</h3>
                                <div class="space-y-4">
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-yellow-800 mb-2"> Production Checklist</h4>
                                        <ul class="list-disc list-inside text-yellow-700 space-y-1">
                                            <li>Set <code>APP_ENV=production</code></li>
                                            <li>Set <code>APP_DEBUG=false</code></li>
                                            <li>Configure proper database credentials</li>
                                            <li>Set up SSL certificate (HTTPS)</li>
                                            <li>Configure web server (Apache/Nginx)</li>
                                            <li>Set proper file permissions (755/644)</li>
                                            <li>Configure backup strategy</li>
                                            <li>Set up monitoring dan logging</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-green-800 mb-2"> Performance Optimization</h4>
                                        <ul class="list-disc list-inside text-green-700 space-y-1">
                                            <li>Enable OPcache untuk PHP</li>
                                            <li>Configure Redis/Memcached untuk caching</li>
                                            <li>Optimize database queries dengan indexes</li>
                                            <li>Enable Gzip compression</li>
                                            <li>Minify CSS/JS assets</li>
                                            <li>Configure CDN untuk static assets</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Troubleshooting -->
                <section id="troubleshooting" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Troubleshooting</h2>
                        
                        <div class="space-y-6">
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <h3 class="font-semibold text-red-800 mb-3"> Common Issues</h3>
                                <div class="space-y-3">
                                    <div>
                                        <h4 class="font-medium text-red-700">1. "Buka shift terlebih dahulu"</h4>
                                        <p class="text-red-600 text-sm">
                                            <strong>Cause:</strong> User belum membuka shift<br>
                                            <strong>Solution:</strong> Akses menu Shift → Buka Shift Baru
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-red-700">2. "Terlalu banyak percobaan login"</h4>
                                        <p class="text-red-600 text-sm">
                                            <strong>Cause:</strong> Rate limiting aktif<br>
                                            <strong>Solution:</strong> Tunggu sesuai countdown atau clear dari admin panel
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-red-700">3. "Storage link not found"</h4>
                                        <p class="text-red-600 text-sm">
                                            <strong>Cause:</strong> Symbolic link belum dibuat<br>
                                            <strong>Solution:</strong> Run <code>php artisan storage:link</code>
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-red-700">4. "Database connection failed"</h4>
                                        <p class="text-red-600 text-sm">
                                            <strong>Cause:</strong> Konfigurasi database salah<br>
                                            <strong>Solution:</strong> Verifikasi settings di .env file
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h3 class="font-semibold text-blue-800 mb-3"> Debug Commands</h3>
                                <div class="code-block">
                                    
# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check storage permissions
ls -la storage/
ls -la bootstrap/cache/

# View logs
tail -f storage/logs/laravel.log

# Check queue status (jika menggunakan queue)
php artisan queue:work --verbose
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Best Practices -->
                <section id="best-practices" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Best Practices</h2>
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4"> Code Quality</h3>
                                <div class="space-y-3">
                                    <div class="bg-blue-50 p-3 rounded">
                                        <h4 class="font-medium text-blue-900">Validation</h4>
                                        <p class="text-sm text-blue-800">Selalu gunakan Laravel validation rules, jangan trust user input</p>
                                    </div>
                                    <div class="bg-green-50 p-3 rounded">
                                        <h4 class="font-medium text-green-900">Error Handling</h4>
                                        <p class="text-sm text-green-800">Comprehensive try-catch dengan informative error messages</p>
                                    </div>
                                    <div class="bg-yellow-50 p-3 rounded">
                                        <h4 class="font-medium text-yellow-900">Logging</h4>
                                        <p class="text-sm text-yellow-800">Log semua critical operations untuk debugging dan audit</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4"> Security</h3>
                                <div class="space-y-3">
                                    <div class="bg-red-50 p-3 rounded">
                                        <h4 class="font-medium text-red-900">Authentication</h4>
                                        <p class="text-sm text-red-800">Implementasi rate limiting dan session security</p>
                                    </div>
                                    <div class="bg-purple-50 p-3 rounded">
                                        <h4 class="font-medium text-purple-900">Authorization</h4>
                                        <p class="text-sm text-purple-800">Role-based access control untuk setiap endpoint</p>
                                    </div>
                                    <div class="bg-indigo-50 p-3 rounded">
                                        <h4 class="font-medium text-indigo-900">Data Protection</h4>
                                        <p class="text-sm text-indigo-800">Input sanitization dan output escaping</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Support -->
                <section id="support" class="mb-12">
                    <div class="bg-white rounded-lg shadow-sm border p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6"> Support & Maintenance</h2>
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4"> Getting Help</h3>
                                <div class="space-y-4">
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-blue-900 mb-2"> Documentation</h4>
                                        <ul class="text-sm text-blue-800 space-y-1">
                                            <li>• Laravel Documentation: laravel.com/docs</li>
                                            <li>• PHP Documentation: php.net/docs</li>
                                            <li>• TailwindCSS: tailwindcss.com/docs</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-green-900 mb-2"> Bug Reporting</h4>
                                        <p class="text-sm text-green-800">
                                            Laporkan bug dengan menyertakan:
                                        </p>
                                        <ul class="text-sm text-green-800 space-y-1 mt-2">
                                            <li>• Steps to reproduce</li>
                                            <li>• Error messages</li>
                                            <li>• Browser dan versi</li>
                                            <li>• Screenshots jika perlu</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4"> Maintenance</h3>
                                <div class="space-y-4">
                                    <div class="bg-yellow-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-yellow-900 mb-2"> Regular Tasks</h4>
                                        <ul class="text-sm text-yellow-800 space-y-1">
                                            <li>• Backup database harian</li>
                                            <li>• Clear old logs (storage/logs)</li>
                                            <li>• Monitor disk space</li>
                                            <li>• Update dependencies</li>
                                            <li>• Security patches</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-purple-900 mb-2"> Monitoring</h4>
                                        <ul class="text-sm text-purple-800 space-y-1">
                                            <li>• Server resource usage</li>
                                            <li>• Database performance</li>
                                            <li>• Error rate monitoring</li>
                                            <li>• User activity logs</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4"> Key Takeaways</h3>
                            <div class="grid md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2"> Security First</h4>
                                    <p class="text-gray-700">Rate limiting, role-based access, input validation</p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2"> Performance</h4>
                                    <p class="text-gray-700">Eager loading, efficient queries, caching strategy</p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2"> Business Logic</h4>
                                    <p class="text-gray-700">Shift management, inventory control, financial tracking</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-semibold mb-3">FLAVORISE</h3>
                    <p class="text-gray-300 text-sm">
                        Dokumentasi lengkap untuk sistem Point of Sale berbasis Laravel (FLAVORISE) dengan fitur keamanan canggih dan analytics komprehensif.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold mb-3"> Quick Links</h3>
                    <ul class="space-y-1 text-sm text-gray-300">
                        <li><a href="#installation" class="hover:text-white">Installation Guide</a></li>
                        <li><a href="#controllers" class="hover:text-white">Controller Analysis</a></li>
                        <li><a href="#security" class="hover:text-white">Security Features</a></li>
                        {{-- <li><a href="#api" class="hover:text-white">API Reference</a></li> --}}
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-3"> Tech Stack</h3>
                    <ul class="space-y-1 text-sm text-gray-300">
                        <li>• Laravel 12+ Framework</li>
                        <li>• MySQL/PostgreSQL Database</li>
                        <li>• TailwindCSS Styling</li>
                        <li>• Blade Template Engine</li>
                        <li>• Eloquent ORM</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-gray-700 text-center">
                <p class="text-gray-400 text-sm">
                    © 2025 Flavorise Documentation. By Lazuardi Mandegar
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
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

        // Active navigation highlighting
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;
                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Enhanced copy functionality for code blocks with proper pre/code structure
        document.addEventListener('DOMContentLoaded', function() {
            // Process all code blocks
            document.querySelectorAll('.code-block').forEach(block => {
                // Skip if already processed (has copy button)
                if (block.querySelector('.copy-btn')) {
                    return;
                }
                
                // Ensure relative positioning for absolute button
                block.style.position = 'relative';
                
                // Create wrapper structure if not exists
                let preElement = block.querySelector('pre');
                let codeElement = block.querySelector('code');
                
                if (!preElement && !codeElement) {
                    // Convert existing content to proper structure
                    const content = block.innerHTML;
                    block.innerHTML = `<pre><code>${content}</code></pre>`;
                    preElement = block.querySelector('pre');
                    codeElement = block.querySelector('code');
                } else if (!preElement && codeElement) {
                    // Wrap code in pre
                    const wrapper = document.createElement('pre');
                    codeElement.parentNode.insertBefore(wrapper, codeElement);
                    wrapper.appendChild(codeElement);
                    preElement = wrapper;
                } else if (preElement && !codeElement) {
                    // Wrap pre content in code
                    const wrapper = document.createElement('code');
                    wrapper.innerHTML = preElement.innerHTML;
                    preElement.innerHTML = '';
                    preElement.appendChild(wrapper);
                    codeElement = wrapper;
                }
                
                // Create copy button
                const copyBtn = document.createElement('button');
                copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                copyBtn.className = 'copy-btn absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white text-xs px-2 py-1 rounded opacity-75 hover:opacity-100 transition-all duration-200 z-10';
                copyBtn.title = 'Copy to clipboard';
                
                // Add copy functionality
                copyBtn.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Get text content from code element, preserving line breaks
                    const codeEl = block.querySelector('code');
                    let textToCopy = '';
                    
                    if (codeEl) {
                        // Get clean text content, preserving structure
                        textToCopy = codeEl.textContent || codeEl.innerText;
                    } else {
                        // Fallback to block content, excluding button
                        const tempBlock = block.cloneNode(true);
                        const buttonInClone = tempBlock.querySelector('.copy-btn');
                        if (buttonInClone) {
                            buttonInClone.remove();
                        }
                        textToCopy = tempBlock.textContent || tempBlock.innerText;
                    }
                    
                    // Clean up the text - remove extra whitespace but preserve intentional line breaks
                    textToCopy = textToCopy
                        .split('\n')
                        .map(line => line.trim())
                        .filter(line => line.length > 0)
                        .join('\n')
                        .trim();
                    
                    // Copy to clipboard using modern API
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(textToCopy).then(() => {
                            showCopySuccess(copyBtn);
                        }).catch(err => {
                            console.error('Copy failed:', err);
                            fallbackCopy(textToCopy, copyBtn);
                        });
                    } else {
                        // Use fallback for older browsers or non-secure contexts
                        fallbackCopy(textToCopy, copyBtn);
                    }
                };
                
                // Insert copy button
                block.appendChild(copyBtn);
            });
        });

        // Success feedback function
        function showCopySuccess(button) {
            const originalHTML = button.innerHTML;
            const originalClasses = button.className;
            
            button.innerHTML = '<i class="fas fa-check"></i>';
            button.className = button.className.replace('bg-gray-700', 'bg-green-600');
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.className = originalClasses;
            }, 2000);
        }

        // Error feedback function
        function showCopyError(button) {
            const originalHTML = button.innerHTML;
            const originalClasses = button.className;
            
            button.innerHTML = '<i class="fas fa-times"></i>';
            button.className = button.className.replace('bg-gray-700', 'bg-red-600');
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.className = originalClasses;
            }, 2000);
        }

        // Fallback copy function for older browsers
        function fallbackCopy(text, button) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.left = '-9999px';
            textarea.style.top = '-9999px';
            textarea.style.opacity = '0';
            textarea.setAttribute('readonly', '');
            textarea.setAttribute('tabindex', '-1');
            
            document.body.appendChild(textarea);
            
            // Select text
            textarea.focus();
            textarea.select();
            textarea.setSelectionRange(0, textarea.value.length);
            
            try {
                const success = document.execCommand('copy');
                if (success) {
                    showCopySuccess(button);
                } else {
                    showCopyError(button);
                }
            } catch (err) {
                console.error('Fallback copy failed:', err);
                showCopyError(button);
            }
            
            // Cleanup
            document.body.removeChild(textarea);
        }

        // Additional utility: Format code blocks on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Apply syntax highlighting classes if available
            document.querySelectorAll('pre code').forEach((block) => {
                // Add language-specific classes for better styling
                if (!block.className.includes('language-php')) {
                    block.classList.add('language-text');
                }
                
                // Ensure proper spacing and formatting
                const content = block.textContent || block.innerText;
                if (content) {
                    // Preserve intentional formatting while cleaning up
                    const formattedContent = content
                        .replace(/^\s+/, '') // hilangkan spasi & newline di awal
                        .replace(/\s+$/, '') // hilangkan spasi & newline di akhir
                        .replace(/\n\s*\n\s*\n/g, '\n\n'); // normalisasi baris kosong

                    block.textContent = formattedContent;
                }
            });
        });
    </script>

    {{-- second script --}}
    {{-- <script>
        // Smooth scrolling for navigation links
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

        // Active navigation highlighting
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;
                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Improved copy code functionality - exclude copy button text
        document.querySelectorAll('.code-block').forEach(block => {
            block.style.position = 'relative';
            
            // Create copy button
            const copyBtn = document.createElement('button');
            copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
            copyBtn.className = 'absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white text-xs px-2 py-1 rounded opacity-75 hover:opacity-100 transition-all duration-200';
            copyBtn.title = 'Copy to clipboard';
            
            // Add copy functionality
            copyBtn.onclick = (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                // Clone the code block to manipulate content
                const tempBlock = block.cloneNode(true);
                
                // Remove the copy button from the cloned content
                const buttonInClone = tempBlock.querySelector('button');
                if (buttonInClone) {
                    buttonInClone.remove();
                }
                
                // Get clean text content without button text
                const textToCopy = tempBlock.textContent || tempBlock.innerText;
                
                // Copy to clipboard
                navigator.clipboard.writeText(textToCopy.trim()).then(() => {
                    // Success feedback
                    const originalHTML = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                    copyBtn.classList.add('bg-green-600');
                    copyBtn.classList.remove('bg-gray-700');
                    
                    // Reset after 2 seconds
                    setTimeout(() => {
                        copyBtn.innerHTML = originalHTML;
                        copyBtn.classList.remove('bg-green-600');
                        copyBtn.classList.add('bg-gray-700');
                    }, 2000);
                }).catch(err => {
                    // Fallback for older browsers
                    console.error('Copy failed:', err);
                    
                    // Create temporary textarea for fallback copy
                    const textarea = document.createElement('textarea');
                    textarea.value = textToCopy.trim();
                    textarea.style.position = 'fixed';
                    textarea.style.left = '-9999px';
                    document.body.appendChild(textarea);
                    textarea.select();
                    
                    try {
                        document.execCommand('copy');
                        // Success feedback
                        const originalHTML = copyBtn.innerHTML;
                        copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                        copyBtn.classList.add('bg-green-600');
                        copyBtn.classList.remove('bg-gray-700');
                        
                        setTimeout(() => {
                            copyBtn.innerHTML = originalHTML;
                            copyBtn.classList.remove('bg-green-600');
                            copyBtn.classList.add('bg-gray-700');
                        }, 2000);
                    } catch (fallbackErr) {
                        console.error('Fallback copy failed:', fallbackErr);
                        copyBtn.innerHTML = '<i class="fas fa-times"></i>';
                        copyBtn.classList.add('bg-red-600');
                        copyBtn.classList.remove('bg-gray-700');
                        
                        setTimeout(() => {
                            copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                            copyBtn.classList.remove('bg-red-600');
                            copyBtn.classList.add('bg-gray-700');
                        }, 2000);
                    }
                    
                    document.body.removeChild(textarea);
                });
            };
            
            block.appendChild(copyBtn);
        });
    </script> --}}

</body>
</html>