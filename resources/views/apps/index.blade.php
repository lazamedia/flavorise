<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="dummy-token">

    <title>Kasir - POS</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .strip{
            background: repeating-linear-gradient(
                90deg,
                #dc2626,
                #dc2626 10px,
                #b91c1c 10px,
                #b91c1c 20px
            );
            height: 2px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        /* Custom animations */
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        .scale-in {
            animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scaleIn {
            from { 
                opacity: 0;
                transform: scale(0.8);
            }
            to { 
                opacity: 1;
                transform: scale(1);
            }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #dc2626;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #b91c1c;
        }
    </style>

</head>
<body class="bg-gray-100 max-h-screen" x-data="posSystem()" x-init="init()">

    <!-- Alert Messages -->
    <div x-show="alert.show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm" 
         :class="alert.type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'">
        <div class="flex items-center justify-between">
            <span x-text="alert.message"></span>
            <button @click="alert.show = false" class="ml-3 text-lg font-bold hover:opacity-70">&times;</button>
        </div>
    </div>

    <header class="w-full py-3 bg-gradient-to-r from-red-800 to-red-700 flex justify-between px-10 content-center items-center shadow-lg">

        <div class="flex items-center gap-10">
            <a href="/apps" class="text-white hover:text-gray-200 transition-colors duration-200">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-2xl font-bold text-white">Kasir</h1>
        </div>
        
        <div class="flex items-center gap-3">
            <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" class="w-10 h-10 rounded-full border-2 border-white shadow-lg" alt="">
            <div class="">
                <h3 class="text-white mb-0 font-semibold">Lazuardi Mandegar</h3>
                <p class="text-sm text-red-200">Admin</p>
            </div>
        </div>

    </header>
    <div class="strip"></div>

    
    <main class="flex max-w-screen-xl mt-10 mx-auto h-full">

        <aside class="w-1/6 px-5">
            <h1 class="text-lg font-bold text-gray-700 mb-4">Kategori</h1>

            <!-- All Categories Button -->
            <div @click="filters.category = ''; filterMenus()" 
                 class="w-full rounded-lg shadow-md py-3 justify-center text-center mt-3 border-2 transition-all duration-200 cursor-pointer"
                 :class="filters.category === '' ? 'border-red-600 bg-red-800 text-white font-semibold' : 'border-gray-300 bg-white hover:text-red-700 hover:border-red-600 hover:shadow-lg'">
                Semua Kategori
            </div>

            <!-- Dynamic Category Buttons -->
            <template x-for="category in categories" :key="category.id">
                <div @click="filters.category = category.id; filterMenus()" 
                     class="w-full rounded-lg shadow-md py-3 justify-center text-center mt-3 border-2 transition-all duration-200 cursor-pointer"
                     :class="filters.category == category.id ? 'border-red-600 bg-red-800 text-white font-semibold' : 'border-gray-300 bg-white hover:text-red-700 hover:border-red-600 hover:shadow-lg'">
                    <span x-text="category.name"></span>
                </div>
            </template>

            <!-- Search Box -->
            <div class="mt-4">
                <input type="text" 
                       x-model="filters.search" 
                       @input="filterMenus()" 
                       placeholder="Cari menu..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm">
            </div>
        </aside>

        <section class="w-3/5 grid grid-cols-4 gap-5 px-5 h-auto content-start max-h-[600px] overflow-y-auto custom-scrollbar">

            <!-- Menu Items -->
            <template x-for="menu in filteredMenus" :key="menu.id">
                <div @click="addToCart(menu)" 
                     class="w-full bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer overflow-hidden group">
                    <div class="h-24 bg-gray-300 group-hover:scale-105 transition-transform duration-300 overflow-hidden">
                        <!-- Updated image source to use storage path or default -->
                        <img :src="menu.image ? `/storage/${menu.image}` : 'https://via.placeholder.com/200x100/e5e7eb/6b7280?text=No+Image'" 
                             class="w-full h-full object-cover" 
                             :alt="menu.name">
                    </div>
                    <div class="p-3">
                        <span class="font-semibold text-gray-800" x-text="menu.name"></span>
                        <p class="text-sm text-gray-500 mt-1">Rp. <span x-text="formatNumber(menu.price)"></span></p>
                    </div>
                </div>
            </template>

            <!-- Empty State -->
            <template x-if="filteredMenus.length === 0">
                <div class="col-span-4 text-center py-8">
                    <i class="fas fa-utensils text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Tidak ada menu yang ditemukan</p>
                </div>
            </template>

        </section>

        <aside class="w-2/6 h-auto p-5">

            <span class="text-2xl font-bold inline-block mb-4 text-gray-800">
                Daftar Pesanan
                <span x-show="cart.length > 0" 
                      class="ml-2 bg-red-100 text-red-800 text-sm px-2 py-1 rounded-full"
                      x-text="`(${cart.length})`"></span>
            </span>

            <div class="border border-red-200 bg-white h-auto rounded-lg shadow-md">
                <ul class="space-y-2 py-3 min-h-[200px] max-h-[300px] overflow-y-auto custom-scrollbar">

                    <!-- Cart Items -->
                    <template x-for="item in cart" :key="item.menu_id">
                        <li class="flex justify-between items-center py-3 px-4 hover:bg-gray-50 transition-colors duration-200 rounded-lg mx-2">
                            <div class="flex gap-3 items-center content-center">
                                <button @click="removeFromCart(item.menu_id)"
                                        class="text-red-500 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center text-sm p-2 transition-all duration-200 hover:scale-110">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                                <div class="">
                                    <span class="font-semibold mb-0 text-gray-800" x-text="item.name"></span>
                                    <p class="text-sm text-gray-500">
                                        <span x-text="item.quantity"></span> x Rp. <span x-text="formatNumber(item.unit_price)"></span>
                                    </p>
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-1 mt-1">
                                        <button @click="updateQuantity(item.menu_id, item.quantity - 1)"
                                                class="w-5 h-5 bg-gray-200 hover:bg-gray-300 rounded text-xs flex items-center justify-center">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="w-6 text-center text-xs font-medium" x-text="item.quantity"></span>
                                        <button @click="updateQuantity(item.menu_id, item.quantity + 1)"
                                                class="w-5 h-5 bg-gray-200 hover:bg-gray-300 rounded text-xs flex items-center justify-center">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <span class="font-bold text-gray-800">
                                Rp. <span x-text="formatNumber(item.quantity * item.unit_price)"></span>
                            </span>
                        </li>
                    </template>

                    <!-- Empty Cart -->
                    <template x-if="cart.length === 0">
                        <li class="text-center py-8">
                            <i class="fas fa-shopping-cart text-3xl text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-500">Keranjang masih kosong</p>
                        </li>
                    </template>

                </ul>
            </div>

            <div class="mt-4 bg-white rounded-lg shadow-md p-4" x-show="cart.length > 0">

                <span class="flex justify-between items-center py-2 mb-3 border-b border-gray-200">
                    <span class="font-bold text-xl text-gray-800">Total</span>
                    <span class="font-bold text-xl text-red-600">Rp. <span x-text="formatNumber(totals.total)"></span></span>
                </span>

                <!-- Payment Method Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <div class="grid grid-cols-2 gap-2">
                        <div @click="checkout.payment_method = 'cash'" 
                             :class="checkout.payment_method === 'cash' ? 'border-red-500 ring-2 ring-red-500 bg-red-50' : 'border-gray-300'"
                             class="cursor-pointer border rounded-lg p-2 text-center hover:border-red-400 transition text-sm">
                            <div class="font-semibold">Tunai</div>
                        </div>
                        <div @click="checkout.payment_method = 'qris'" 
                             :class="checkout.payment_method === 'qris' ? 'border-red-500 ring-2 ring-red-500 bg-red-50' : 'border-gray-300'"
                             class="cursor-pointer border rounded-lg p-2 text-center hover:border-red-400 transition text-sm">
                            <div class="font-semibold">QRIS</div>
                        </div>
                    </div>
                </div>

                <!-- Cash Amount Input -->
                <div x-show="checkout.payment_method === 'cash'" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Uang Diterima</label>
                    <input type="number" 
                           x-model.number="checkout.paid_amount" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm"
                           :placeholder="formatNumber(totals.total)">
                </div>

                <!-- Customer Notes -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <textarea x-model="checkout.customer_notes" 
                              rows="2" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm"
                              placeholder="Catatan tambahan..."></textarea>
                </div>

                <!-- Clear Cart Button -->
                <button @click="clearCart()" 
                        class="w-full mb-2 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors text-sm">
                    <i class="fas fa-trash mr-2"></i>Kosongkan Keranjang
                </button>

                <!-- Checkout Button -->
                <button @click="showCheckoutModal = true" 
                        class="font-semibold bg-gradient-to-r from-red-800 to-red-700 hover:from-red-900 hover:to-red-800 w-full py-4 text-xl text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-credit-card mr-2"></i>
                    Bayar
                </button>

            </div>

        </aside>

    </main>

    <!-- Checkout Confirmation Modal -->
    <div x-show="showCheckoutModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50"
         style="display: none;">
        
        <div x-show="showCheckoutModal"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90"
             class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden max-h-[80vh] overflow-y-auto">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-800 to-red-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white">
                        <i class="fas fa-receipt mr-2"></i>Konfirmasi Checkout
                    </h3>
                    <button @click="showCheckoutModal = false" 
                            class="text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="px-6 py-6">
                
                <!-- Order Summary -->
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-800 mb-3">Ringkasan Pesanan</h4>
                    <div class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar">
                        <template x-for="item in cart" :key="item.menu_id">
                            <div class="flex justify-between text-sm py-1">
                                <span class="flex-1">
                                    <span x-text="item.quantity"></span>x 
                                    <span x-text="item.name"></span>
                                </span>
                                <span class="font-medium">Rp <span x-text="formatNumber(item.quantity * item.unit_price)"></span></span>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Payment Details -->
                <div class="border-t pt-4 space-y-2 mb-6">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total:</span>
                        <span class="text-red-600">Rp <span x-text="formatNumber(totals.total)"></span></span>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span>Pembayaran:</span>
                        <span x-text="checkout.payment_method === 'cash' ? 'Tunai' : 'QRIS'"></span>
                    </div>
                    
                    <template x-if="checkout.payment_method === 'cash'">
                        <div>
                            <div class="flex justify-between text-sm">
                                <span>Uang Diterima:</span>
                                <span>Rp <span x-text="formatNumber(checkout.paid_amount || 0)"></span></span>
                            </div>
                            <div class="mt-2">
                                <div class="flex justify-between font-semibold text-sm mb-1" 
                                     :class="change >= 0 ? 'text-green-600' : 'text-red-600'">
                                    <span>Kembalian:</span>
                                </div>
                                <div class="w-full p-3 border-2 border-dashed border-green-500 shadow rounded flex justify-center">
                                    <span x-text="`Rp ${formatNumber(change)}`" class="text-2xl text-center font-bold mx-auto"></span>
                                </div>
                                <div x-show="change < 0" class="text-red-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Uang tidak cukup!
                                </div>
                            </div>
                        </div>
                    </template>
                    
                    <div x-show="checkout.customer_notes" class="text-sm">
                        <span class="font-medium">Catatan:</span>
                        <span x-text="checkout.customer_notes"></span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button @click="showCheckoutModal = false" 
                            class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </button>
                    <button @click="processCheckout()" 
                            :disabled="checkout.payment_method === 'cash' && change < 0"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-red-800 to-red-700 hover:from-red-900 hover:to-red-800 disabled:from-gray-400 disabled:to-gray-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 disabled:transform-none">
                        <span x-show="!processing">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </span>
                        <span x-show="processing">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

<script>
    function posSystem() {
        return {
            // Data from Laravel backend
            menus: @json($menus),
            categories: @json($categories),
            
            cart: [],
            filteredMenus: [],
            filters: {
                category: '',
                search: ''
            },
            checkout: {
                payment_method: 'cash',
                tax: 0,
                discount: 0,
                paid_amount: 0,
                customer_notes: ''
            },
            totals: {
                subtotal: 0,
                total: 0
            },
            showCheckoutModal: false,
            processing: false,
            alert: {
                show: false,
                message: '',
                type: 'success'
            },

            init() {
                this.filteredMenus = [...this.menus];
                this.calculateTotals();
                console.log('POS System initialized');
            },

            get change() {
                if (this.checkout.payment_method === 'cash') {
                    return (this.checkout.paid_amount || 0) - this.totals.total;
                }
                return 0;
            },

            addToCart(menu) {
                const existingItem = this.cart.find(item => item.menu_id === menu.id);
                
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    this.cart.push({
                        menu_id: menu.id,
                        name: menu.name,
                        image: menu.image,
                        unit_price: parseFloat(menu.price),
                        quantity: 1
                    });
                }
                
                this.calculateTotals();
                this.showAlert('Item ditambahkan ke keranjang', 'success');
            },

            updateQuantity(menuId, newQuantity) {
                if (newQuantity <= 0) {
                    this.removeFromCart(menuId);
                    return;
                }
                
                const item = this.cart.find(item => item.menu_id === menuId);
                if (item) {
                    item.quantity = newQuantity;
                    this.calculateTotals();
                }
            },

            removeFromCart(menuId) {
                this.cart = this.cart.filter(item => item.menu_id !== menuId);
                this.calculateTotals();
                this.showAlert('Item dihapus dari keranjang', 'success');
            },

            clearCart() {
                if (confirm('Kosongkan keranjang?')) {
                    this.cart = [];
                    this.calculateTotals();
                    this.showAlert('Keranjang dikosongkan', 'success');
                }
            },

            calculateTotals() {
                this.totals.subtotal = this.cart.reduce((sum, item) => {
                    return sum + (item.unit_price * item.quantity);
                }, 0);
                
                this.totals.total = this.totals.subtotal + (this.checkout.tax || 0) - (this.checkout.discount || 0);
            },

            filterMenus() {
                this.filteredMenus = this.menus.filter(menu => {
                    const matchesCategory = !this.filters.category || menu.category_id == this.filters.category;
                    const matchesSearch = !this.filters.search || 
                        menu.name.toLowerCase().includes(this.filters.search.toLowerCase());
                    return matchesCategory && matchesSearch;
                });
            },

            async processCheckout() {
                if (this.cart.length === 0) {
                    this.showAlert('Keranjang kosong', 'error');
                    return;
                }

                if (this.checkout.payment_method === 'cash' && this.change < 0) {
                    this.showAlert('Uang tidak cukup', 'error');
                    return;
                }

                this.processing = true;

                const checkoutData = {
                    cart: this.cart,
                    payment_method: this.checkout.payment_method,
                    tax: this.checkout.tax || 0,
                    discount: this.checkout.discount || 0,
                    paid_amount: this.checkout.payment_method === 'cash' ? 
                        (this.checkout.paid_amount || 0) : this.totals.total,
                    customer_notes: this.checkout.customer_notes,
                    subtotal: this.totals.subtotal,
                    total: this.totals.total,
                    change_amount: Math.max(0, this.change)
                };

                try {
                    const response = await fetch('{{ route("apps.pos.checkout") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(checkoutData)
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        this.cart = [];
                        this.checkout = {
                            payment_method: 'cash',
                            tax: 0,
                            discount: 0,
                            paid_amount: 0,
                            customer_notes: ''
                        };
                        this.calculateTotals();
                        this.showCheckoutModal = false;
                        this.showAlert(result.message, 'success');
                    } else {
                        this.showAlert(result.message || 'Terjadi kesalahan', 'error');
                    }
                } catch (error) {
                    console.error('Checkout error:', error);
                    this.showAlert('Terjadi kesalahan jaringan', 'error');
                }

                this.processing = false;
            },

            showAlert(message, type = 'success') {
                this.alert = {
                    show: true,
                    message: message,
                    type: type
                };
                
                setTimeout(() => {
                    this.alert.show = false;
                }, 5000);
            },

            formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number || 0);
            }
        }
    }
</script>

</body>
</html>